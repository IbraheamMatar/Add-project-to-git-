






<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">stores soft deleted</div>

                <div class="card-body">


                        @if ($stores->count()>0)
                        <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col"> No </th>
                                    <th scope="col"> Title </th>

                                   <th scope="col">Restore</th>
                                   {{--    <th scope="col">Delete</th>  --}}

                                  </tr>
                                </thead>
                                <tbody>

                                 @foreach ($stores as $store)
                                 <tr>
                                         <th scope="row">
                                   <img src="{{$store->featrued}}" alt="{{$store->title}}" class="img-thumbnail" width="100px" height="100px">

                                         </th>
                                         <th scope="row">{{$store->title}}</th>

                                         <td>
                                                <a class="" href="{{route('store.restore',['id' =>$store->id ])}}">
                                                     <i class="fas fa-edit"> Restore</i>
                                              </a>
                                         </td>
                                         <td>
                                         <a class="" href="{{route('store.hdelete',['id' =>$store->id ])}}">
                                                 <i class="far fa-trash-alt"> Hdelete</i>
                                         </a>
                                        </td>
                                       </tr>
                                 @endforeach

                                 @else


                                        <p scope="row" class="text-center">No trashed stores</p>



                                 @endif


                                </tbody>
                              </table>






                </div>
            </div>
        </div>
    </div>
</div>
