<?php

namespace App\Http\Controllers\Apis;

use App\Currentaccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrentAccountController extends Controller
{
    static $perPage = 15;

    public function index(){
        try {

            $data = Currentaccount::orderByDesc('created_at')
                ->paginate(self::$perPage);

            return response()->json([
                'data' => $data,
                'message' => 'Success'
            ], 200
            );
        } catch (\Exception $exception) {
            return response()->json([
                    'message' => $exception
                ],201

            );
        }
    }
    public function edit($id){

        try {

            $data = Currentaccount::all();

            return response()->json([
                'data' => $data,
                'message' => 'Success'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                    'message' => $exception
                ]

            );
        }
    }
    public function store(Request $request)
    {


        try {
            $account = Currentaccount::updateOrCreate([
                'id' => $request->get('id')
            ],
                [
                    'code' => $request->get('code'),
                    'company' => $request->get('company'),
                    'email' => $request->get('email'),
                    'tax' => $request->get('tax'),
                    'taxname' => $request->get('taxname'),
                    'telephone' => $request->get('telephone'),
                    'user'=> $request->get('user'),
                    'address' => $request->get('address')
                ]);

            return response()->json([
                'data' => $account,
                'message' => 'Success'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                    'message' => $exception
                ]

            );
        }


    }
}
