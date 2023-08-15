@php
  $isEdit =   isset($post) ? true : false;
  $url  = $isEdit ? route('posts.update', $post->id) : route('posts.store');
@endphp
<form action="{{$url}}" method="post" data-form="ajax-form" data-redirect="{{route('posts.index')}}" enctype="multipart/form-data">
    @if ($isEdit)
     @method('PUT')
    @endif
        @csrf
    <div class="row">
        <div class="form-group col-lg-6">
            <label for="Name">Category <span class="text-danger">*</span></label>
            <select name="category_id" id="category_id" class="form-control select2">
                <option value="" selected disabled>Please select category</option>
                @foreach (App\Models\Category::dropDown() as $category)
                <option value="{{$category->id}}" @if ($isEdit && $post->category_id == $category->id)selected @endif>{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-lg-6">
            <label for="title">Title <span class="text-danger">*</span></label>
           <input type="text" class="form-control" id="title" name="title" value="{{$isEdit ? $post->title : ''}}">
        </div>

        <div class="form-group col-lg-6">
            <label for="thumbnail">Thumbnail</label>
            <input type="file" class="form-control" name="image">
        </div>

        <div class="form-group col-lg-6">
            <label for="thumbnail">Status</label>
            <select name="status" id="status" class="form-control select2">
                <option value="published" @if ($isEdit && $post->status == "published") selected   @endif>published </option>
                <option value="unpublished" @if ($isEdit && $post->status == "unpublished~") selected   @endif>unpublished</option>
            </select>
        </div>

        <div class="col-md-12 form-group">
            <label for="Summernote">Description</label>
            <textarea id="summernote" name="content" class="form-control">{{$isEdit ? $post->content : ''}}</textarea>
        </div>
        <div class="col-lg-12">
            <button style="float: right;" type="submit" class="btn btn-primary" data-button="submit">Submit</button>
        </div>
    </div>
</form>
