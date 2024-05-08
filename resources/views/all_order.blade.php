
@include('inc/header')

 <!-- partial -->
 <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
          <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
           <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                <div class="mdc-card p-0">
                  <div style="padding:10px 0px 15px;">
                  <h6 class="card-title card-padding pb-0" style="color:#7a00ff;"></h6>
                  <div style="position:absolute;right:120px;top:120px;padding:5px;">
                  <a href="{{route('dashboard')}}"><i class="fa fa-home" style="font-size:24px;color:#7a00ff;"  title="Home"></i></a>
                  </div>
                  <div style="position:absolute;right:60px;top:120px;padding:5px;"><a href="{{route('orders.add')}}"><i class="fa fa-plus-circle" style="font-size:24px;color:#7a00ff;"  title="new order"></i></a></div></div>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="example">
                      <thead>
                        <tr>
                          <th class="text-center">S. NO</th>
                          <th class="text-center">Date</th>
                          <th class="text-center">Name</th>
                          <th class="text-center">Mode</th>
                          <th class="text-center">Acc.NO</th>
                          <th class="text-center">Bank</th>
                         <!-- <th class="text-center">IFSC</th>
                          <th class="text-center">address</th>-->
                          <th class="text-center">Mobile</th>
                         <!-- <th class="text-center">Phone</th>-->
                          <th class="text-center">Amount</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($orders as $order)
                        <tr>
                          <td class="text-center">{{ $order->ind_id }}</td>
                          <td class="text-center">{{ \Carbon\Carbon::parse($order->ord_date)->format('d-m-Y') }}</td>
                          <td class="text-center">{{ $order->name }}</td>
                          <td class="text-center">{{ $order->mode }}</td>
                          <td class="text-center">{{ $order->acc_no }}</td>
                           @if($order->bankDetails)
                       <td class="text-center"> {{ $order->bankDetails->bank_name ?? 'No Bank Name' }}</td>
                    @else
                        <td class="text-center">No Bank Details</td>
                    @endif
                          <!--<td class="text-center">{{ $order->ifsc }}</td>
                          <td class="text-center">{{ $order->address }}</td>-->
                          <td class="text-center">{{ $order->mobile_1 }}</td>
                          <!--<td class="text-center">{{ $order->mobile_2 }}</td>-->
                          <td class="text-center">{{ $order->amount }}</td>
                          <td class="text-center"> <button class="mdc-button mdc-button--raised filled-button--secondary" data-bs-toggle="modal" data-bs-target="#myModal{{$order->id}}"  title="delete">
                          <i class="fa fa-trash"></i>
                    </button>
                    <a href="{{route('edit_orders.view',$order->id)}}"><button class="mdc-button mdc-button--raised filled-button--warning"  title="edit">
                          <i class="fa fa-pencil"></i>
                    </button></a></td>
                        </tr>
                        <!-- The Modal -->
<div class="modal" id="myModal{{$order->id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Order</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
       
      <!-- Modal body -->
      <div class="modal-body">
      <form action="{{ route('terminate_order.destroy', $order->id) }}" method="post">
       @csrf
       @method('DELETE')
        Are you sure do you want to delete?
      </div>
       <input type="hidden" name="gcc_agent" value="{{ $order->gcc_agent }}">
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Yes</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
      </div>
   </form>
    </div>
  </div>
</div>
                        @endforeach

                      </tbody>
                         <tfoot>
        <tr>
            <!-- ... your existing table cells ... -->
            <td class="text-center"><strong>Total:</strong></td>
            <td></td> <!-- Assuming other cells are empty for the total row -->
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         
            <!--<td></td>
         
            <td></td>-->
            <td></td>
            <!--<td></td>-->
            <td class="text-center"><strong>{{ $sumAmount }}</strong></td>
          
            <td></td>
        </tr>
    </tfoot> 
                      
                    </table>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>


 <script>
        new DataTable('#example', {
          dom: 'Plfrtip'
          });
        </script>

        <script>
          $(document).ready(function() {
    var table = $('#example').DataTable({
        searchPanes: true
    });
    table.searchPanes.container().prependTo(table.table().container());
    table.searchPanes.resizePanes();
      });  
      </script>
@include('inc/footer')        