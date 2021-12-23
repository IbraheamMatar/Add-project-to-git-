






<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit store {{$stores->title}}</div>

                <div class="card-body">




                    @if(count($errors)>0)
                    <ul class="navbar-nav mr-auto">
                            @foreach ($errors->all() as $error)
                            <li class="nav-item active">
                                     {{$error}}
                                  </li>
                            @endforeach

                          </ul>
                          @endif



                    <form action="{{route('store.update',['id' => $stores->id ])}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}


                               <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" name="category_id" id="category">

                                     @foreach ($categories as $category)
                                     @if ($category->id == $stores->category_id)
                                     <option value="{{$category->id}}" selected>{{$category->name}}</option>

                                     @else
                                     <option value="{{$category->id}}" >{{$category->name}}</option>
                                     @endif

                                     @endforeach


                                    </select>
                                  </div>






                        <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" name="title"  value="{{$stores->title}}">
                         </div>
                         <div class="form-group">
                            <label for="content">Description</label>
                            <textarea class="form-control" name="content" id="content" rows="8" cols="8">
                                    {!! $stores->content !!}
                            </textarea>
                          </div>
                          <div class="form-group">
                            <label for="featured">Photo</label>
                            <input type="file" class="form-control-file" name="featured">
                          </div>


                        <button type="submit" class="btn btn-primary">Update</button>
                      </form>








                </div>
            </div>
        </div>
    </div>
</div>



@section('styles')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">

@endsection


@section('scripts')

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js" defer></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script>
    $(document).ready(function() {
      $('#content').summernote();
    });
</script>

@endsection
