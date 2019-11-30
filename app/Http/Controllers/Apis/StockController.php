<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Stock;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use Spatie\Searchable\Search;

class StockController extends Controller
{
    static $perPage = 15;
    public function getCurrentStock(Request $request)
    {

        $search = $request->get('term');
        $data = Stock::where('name', 'LIKE', '%' . $search . '%')->get();
        return response()->json($data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::orderByDesc('created_at')
            ->paginate(self::$perPage)
            ;

        return response()->json($stocks);
    }


    public function filter(Request $request)
    {
      //  return $request->get('code');
            $result = Stock::where(function ($query) use ($request){
                if($request->get('searchCode')!=''){

                    $query->where('code','LIKE' ,'%'.$request->get('searchCode').'%');
                }
//                if($request->has('name')){
//
//                    $query->where('name','LIKE' ,'%'.$request->get('name').'%');
//                }
            })
                ->paginate(self::$perPage);
            return response()->json([
                'data' => $result,
                'message' => 'Success'
            ]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $stock = Stock::updateOrCreate([
                'id' => $request->get('id')
            ],
                [
                    'code' => $request->get('code'),
                    'name' => $request->get('name'),
                    'unit' => $request->get('unit'),
                    'tax' => $request->get('tax'),
                ]);

            return response()->json([
                'data' => $stock,
                'message' => 'Success'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                    'message' => $exception
                ]

            );
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = Stock::find($id);

        try {
            return response()->json([
                'data' => $stock,
                'message' => 'Success'
            ]);
        } catch (Exception $e) {
            return response()->json([

                'message' => $e
            ]);
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
