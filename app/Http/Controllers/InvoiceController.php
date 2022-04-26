<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceHasItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Invoice::with('items', 'transmitter', 'receiver')->where('status', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $number = Invoice::latest()->first();
            if ($number) {
                $consecutive = $number->id + 1;
            } else {
                $consecutive = 1;
            }
            $billing = 'FAC' . $consecutive;
            $data['number'] = $billing;
            $data['value'] = $request->value;
            $data['total_value'] = $request->total_value;
            $data['iva'] = $request->iva;
            $data['receiver_id'] = $request->receiver_id;
            $data['transmitter_id'] = $request->transmitter_id;

            $invoice = Invoice::create($data);
            DB::commit();
            $invoice->save();

            $items = $request->items;
            foreach ($items as $item) {
                $itemData['invoice_id'] = $invoice->id;
                $itemData['item_id'] = $item['id'];
                $itemData['quantity'] = $item['quantity'];
                $new_item = InvoiceHasItem::create($itemData);
                DB::commit();
                $new_item->save();
            }

            if ($invoice) {
                return response()->json([
                    'type' => 'success',
                    'message' => 'Facturado con éxito',
                    'data' => $invoice,
                ], 201);
            } else {
                return response()->json([
                    'type' => 'error',
                    'message' => 'Error al guardar',
                    'product' => [],
                ], 204);
            }
        } catch (Exception $e) {
            return response()->json([
                'type' => 'error',
                'message' => 'Error al guardar',
                'data' => [$data]
            ], 204);
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Invoice::with('items')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $sale = Invoice::find($id);

            $sale->value = $request->value;
            $sale->total_value = $request->total_value;
            $sale->receiver_id = $request->receiver_id;
            $sale->transmitter_id = $request->transmitter_id;
            $sale->iva = $request->state;
            DB::commit();
            $sale->save();

            DB::table('invoice_has_items')->where('invoice_id', $id)->delete();
            $items = $request['items'];
            foreach ($items as $item) {
                $itemData['invoice_id'] = $id;
                $itemData['item_id'] = $item->id;
                $itemData['quantity'] = $item->quantity;

                $new_item = InvoiceHasItem::create($itemData);
                DB::commit();
                $new_item->save();
            }

            if ($sale) {
              return response()->json([
                'type' => 'success',
                'message' => 'Actualizado con éxito',
                'data' => $sale
              ], 202);
            } else {
              return response()->json([
                'type' => 'error',
                'message' => 'Error al actualizar',
                'data' => []
              ], 204);
            }
          } catch (Exception $e) {
            return response()->json([
              'type' => 'error',
              'message' => 'Error al actualizar',
              'data' => []
            ], 204);
            DB::rollBack();
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request, $id)
    {
        return Invoice::with('items')->where('status', 1)
            ->Where(function($query) {
                $query->where('name', 'Abigail')
                      ->where('votes', '>', 50);
        })->get();
    }


}
