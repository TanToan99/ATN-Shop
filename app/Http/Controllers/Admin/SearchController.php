<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');
        $data = Category::where("name", 'like', '%'.$query.'%')->get();
        dd($data);
        if ($request->ajax()) {
        	$output = "";
        	$query = $request->all();
        	if ($query != '') {
        		$data = Category::where("name", 'like', '%'.$query.'%')->get();
        	} else {
        		$data = Category::orderBy('id', 'desc')->get();
        	}
        	$total_row = $data->count();
        	if ($total_row > 0) {
        		foreach ($data as $row) {
        			$output = '
					<tr>
						<td>'.$row->id.'</td>
						<td>'.$row->name.'</td>
						<td>edit</td>
						<td>delete</td>
					</tr>
        			';
        		}
        	}
        	else
      			{
       				$output = '
       				<tr>
        				<td align="center" colspan="5">No Data Found</td>
       				</tr>
       			';
      		}
      		$data = [
      			'table_data' => $output,
      			'total_row' => $total_row
      		];
      		echo json_encode($data);
          
        }

    }
}