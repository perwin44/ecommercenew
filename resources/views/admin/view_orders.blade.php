<!DOCTYPE html>
<html>
  <head>

    @include('admin.css')

    <style type="text/css">

    table{
        border: 2px solid skyblue;
        text-align: center;
    }
    th{
        background-color: skyblue;
        padding: 10px;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        color: white;
    }
    .table-center{
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px;
    }
    td{
        padding: 10px;
        color: white;
        border: 1px solid skyblue;
    }

    </style>

  </head>
  <body>

    @include('admin.header')

    @include('admin.sidebar')

      <div class="page-content">
        <div class="">
          <div class="container-fluid">

            <h3 style="padding: 10px;">All Orders</h3>
            <br>


            <div class="table-center">

                <table>

                    <tr>
                        <th>Customer name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Payment Status</th>
                        <th>Status</th>
                        <th>Change Status</th>
                        <th>Print PDF</th>
                    </tr>

                    @foreach ($data as $data)

                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->rec_address}}</td>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->product->title}}</td>
                        <td>{{$data->product->price}}</td>
                        <td>
                            <img style="height:150px;width:150px;" src="/products/{{$data->product->image}}">
                        </td>
                        <td>{{$data->payment_status}}</td>
                        <td>
                            @if ($data->status == 'in progress')
                            <span style="color: red;">{{$data->status}}</span>

                            @elseif ($data->status == 'On The Way')
                            <span style="color: skyblue;">{{$data->status}}</span>

                            @else
                            <span style="color: yellow;">{{$data->status}}</span>

                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{url('on_the_way',$data->id)}}">On the way</a>
                            <a class="btn btn-success" href="{{url('delivered',$data->id)}}">Delivered</a>
                        </td>
                        <td>
                            <a class="btn btn-secondary" href="{{url('print_pdf',$data->id)}}">Print PDF</a>
                        </td>
                    </tr>
                    @endforeach

                </table>

            </div>











          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('/admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('/admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('/admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('/admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('/admincss/js/front.js')}}"></script>
  </body>
</html>
