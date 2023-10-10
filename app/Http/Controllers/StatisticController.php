<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class StatisticController extends Controller
{

    public $data;
    function index(Request $request, $id=1){

        if ($id == 1){
            $data = Group::query();
        }else{
            $data = Worker::query();
        }

        if (!empty($request->query('text'))){

            if ($id == 1){
                $data = $data->where('title','like', '%'.$request->query('text').'%');
            }else{
                $data = $data->where('name','like', '%'.$request->query('text').'%');

            }
        }

        $carbon = Carbon::now();
        if ($request->query('filter') == 1) {
            $today = $carbon;

            $data = $data->withCount(['clients' => function ($query) use ($today) {
                $query->whereDay('created_at', $today);
            }, 'location' => function ($query) use ($today) {
                $query->whereDay('created_at', $today);
            }])->with('clients',function ($query)use ($today){
                $query->whereDay('created_at', $today)->where('status_id','>', '3');
            });

        } elseif ($request->query('filter') == 2) {
            $startOfWeek =$carbon->startOfWeek()->format('Y-m-d H:i');
            $endOfWeek = $carbon->endOfWeek()->format('Y-m-d H:i');

            $data = $data->withCount(['clients'=> function ($query)use ($startOfWeek,$endOfWeek){
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
            },'location'=> function ($query)use ($startOfWeek,$endOfWeek){
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
            }])->with('clients',function ($query)use ($startOfWeek,$endOfWeek){
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek])->where('status_id','>', '3');
            });
        } elseif ($request->query('filter') == 3) {
            $startOfMonth = $carbon->startOfMonth()->format('Y-m-d H:i');
            $endOfMonth = $carbon->endOfMonth()->format('Y-m-d H:i');
            $data = $data->withCount(['clients'=> function ($query)use ($startOfMonth,$endOfMonth){
                $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
            },'location'=> function ($query)use ($startOfMonth,$endOfMonth){
                $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
            }])->with('clients',function ($query)use ($startOfMonth,$endOfMonth){
                $query->whereBetween('created_at', [$startOfMonth,$endOfMonth])->where('status_id','>', '3');
            });
        } elseif ($request->query('filter') == 4) {
            $startOfYear = $carbon->startOfYear()->format('Y-m-d H:i');
            $endOfYear = $carbon->endOfYear()->format('Y-m-d H:i');

            $data = $data->withCount(['clients'=> function ($query)use ($startOfYear,$endOfYear){
                $query->whereBetween('created_at', [$startOfYear,$endOfYear]);
            },'location'=> function ($query)use ($startOfYear,$endOfYear){
                $query;
            }])->with('clients',function ($query)use ($startOfYear,$endOfYear){
                $query->whereBetween('created_at', [$startOfYear,$endOfYear])->where('status_id','>', '3');
            });
        }else{

            if ($id == 1){
                $data = $data->withCount(['clients', 'location']);
            }else{
                $data = $data->withCount(['clients', 'location']);
            }
            $data->sale = $data->with('clients',function ($query){
                $query->where('status_id','>', '3');
            });
        }

        $data = $data->orderByDesc('clients_count')->get();


        return view('admin.statistic.index',compact('data'));
    }



public function generatePDF(Request $request, $id=1)
{
    if ($id == 1){
        $data = Group::query();
    }else{
        $data = Worker::query();
    }

    if (!empty($request->query('text'))){

        if ($id == 1){
            $data = $data->where('title','like', '%'.$request->query('text').'%');
        }else{
            $data = $data->where('name','like', '%'.$request->query('text').'%');

        }
    }

    $carbon = Carbon::now();
    if ($request->query('filter') == 1) {
        $today = $carbon;

        $data = $data->withCount(['clients' => function ($query) use ($today) {
            $query->whereDay('created_at', $today);
        }, 'location' => function ($query) use ($today) {
            $query->whereDay('created_at', $today);
        }])->with('clients',function ($query)use ($today){
            $query->whereDay('created_at', $today)->where('status_id','>', '3');
        });

    } elseif ($request->query('filter') == 2) {
        $startOfWeek =$carbon->startOfWeek()->format('Y-m-d H:i');
        $endOfWeek = $carbon->endOfWeek()->format('Y-m-d H:i');

        $data = $data->withCount(['clients'=> function ($query)use ($startOfWeek,$endOfWeek){
            $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        },'location'=> function ($query)use ($startOfWeek,$endOfWeek){
            $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        }])->with('clients',function ($query)use ($startOfWeek,$endOfWeek){
            $query->whereBetween('created_at', [$startOfWeek, $endOfWeek])->where('status_id','>', '3');
        });
    } elseif ($request->query('filter') == 3) {
        $startOfMonth = $carbon->startOfMonth()->format('Y-m-d H:i');
        $endOfMonth = $carbon->endOfMonth()->format('Y-m-d H:i');
        $data = $data->withCount(['clients'=> function ($query)use ($startOfMonth,$endOfMonth){
            $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        },'location'=> function ($query)use ($startOfMonth,$endOfMonth){
            $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        }])->with('clients',function ($query)use ($startOfMonth,$endOfMonth){
            $query->whereBetween('created_at', [$startOfMonth,$endOfMonth])->where('status_id','>', '3');
        });
    } elseif ($request->query('filter') == 4) {
        $startOfYear = $carbon->startOfYear()->format('Y-m-d H:i');
        $endOfYear = $carbon->endOfYear()->format('Y-m-d H:i');

        $data = $data->withCount(['clients'=> function ($query)use ($startOfYear,$endOfYear){
            $query->whereBetween('created_at', [$startOfYear,$endOfYear]);
        },'location'=> function ($query)use ($startOfYear,$endOfYear){
            $query;
        }])->with('clients',function ($query)use ($startOfYear,$endOfYear){
            $query->whereBetween('created_at', [$startOfYear,$endOfYear])->where('status_id','>', '3');
        });
    }else{

        if ($id == 1){
            $data = $data->withCount(['clients', 'location']);
        }else{
            $data = $data->withCount(['clients', 'location']);
        }
        $data->sale = $data->with('clients',function ($query){
            $query->where('status_id','>', '3');
        });
    }

    $data = $data->orderByDesc('clients_count')->get();

    $pdf = PDF::loadView('pdf.view', compact('data'));

    return $pdf->download('Agetation.pdf');
}

}
