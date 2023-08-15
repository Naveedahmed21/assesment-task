@php
    $isEdit = isset($category) ? true : false;
    $url  = $isEdit ? route('categories.update', $category->id) : route('categories.store');
@endphp
<form action="{{$url}}" method="post">
    @if ($isEdit)
    @method('PUT')

    @endif
    @csrf
    <div class="row">
        <div class="form-group col-lg-6">
            <label for="Name">Name<span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$isEdit ? $category->name  : ''}}" >
            @error('name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-lg-6">
            <label for="status">Status <span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control select2">
                <option value="active" @if ($isEdit  && $category->status == 'active')selected @endif>active</option>
                <option value="Inactive" @if ($isEdit  && $category->status == 'Inactive')selected @endif>Inactive</option>
            </select>
            @error('status')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-12">
            <button style="float: right;" type="submit" class="btn btn-primary" data-button="submit">Submit</button>
        </div>
    </div>
</form>
