@php  $ASSET_URL = asset('admin-theme').'/'; @endphp
@extends('admin.layouts.app')
@section('head_scripts')
<title>@lang('page_title.Admin.page_title')</title>
@endsection
@section('content')
    <div class="tp_main_content_wrappo">
        <div class="tp_tab_wrappo">
            <ul>
                <li><a href="{{ route('admin.blog.index') }}">Manage Blogs</a></li>
                <li class="active"><a href="#">Edit Blogs</a></li>
            </ul>
        </div>
        <div class="tp_tab_content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form id="pages-post-form" action="{{ route('admin.blog.store') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="tp_catset_box tp_add_pages">
                            <div class="tp_form_wrapper">
                                <label class="mb-2">Name<sup>*</sup></label>
                                <input class="form-control" type="text" placeholder="Enter Name" name="name"
                                    value="{{ @$data->name }}">
                            </div>
                            <div class="tp_form_wrapper">
                                <label class="mb-2">Slug<sup>*</sup></label>
                                <input class="form-control" type="text" placeholder="Enter Slug" name="slug"
                                    value="{{ @$data->slug }}" >
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                    <div class="tp_form_wrapper">
                                        <label class="mb-2">Image<sup>*</sup></label>
                                        <input type="file" class="form-control" name="image" id='image'
                                            placeholder="Upload image">
                                        @if (isset($data->image))
                                            <input class="form-control" type="hidden" name="image"
                                                value="{{ @$data->image }}">
                                            <div class="tp_form_wrapper mt-2">
                                            <img src="{{ asset('storage/' . $data->image) }}" max-height="200px" width="200px">

                                            </div>
                                        @endif
                                    </div>
                                </div>
                            <div class="col-lg-6 col-md-12">
    <div class="tp_form_wrapper tp_pro_selectcat">
        <label class="mb-2">Blog Category<sup>*</sup></label>
        <div class="tp_custom_select tp_select_product">
            <select class="form-select" aria-label="" name="category_id">
                <option value="{{ @$data->category_id }}">Choose category</option>
                @forelse($all_category as $row)
                    <option value="{{ $row->id }}" {{ @$data->category_id == $row->id ? 'selected' : '' }}>
                        {{ $row->name }}
                    </option>
                @empty
                    <option value="{{ @$data->category_id }}" disabled>No categories found</option>
                @endforelse
            </select>
            <label id="category_id-error" class="error" for="category_id"></label>
        </div>
    </div>
</div>

                          
                            <div class="tp_form_wrapper">
                                <label class="mb-2">Content</label>
                                <textarea id="theme-editor" placeholder="Enter Content" name="description" rows="5" cols="50">{{ @$data->description }}</textarea>
                            </div>
                            <div class="tp_form_wrapper">
                                <label class="mb-2">Meta Title<sup>*</sup></label>
                                <input class="form-control" type="text" placeholder="Enter Title" name="meta_title"
                                    value="{{ @$data->meta_title }}">
                            </div>
                            <div class="tp_form_wrapper">
                                <label class="mb-2">Meta keywords<sup>*</sup></label>
                                <input class="form-control" type="text" placeholder="Enter description"
                                    name="meta_keyword" value="{{ @$data->meta_keyword }}">
                            </div>
                            <div class="tp_form_wrapper">
                                <label class="mb-2">Sub Description<sup>*</sup></label>
                                <input class="form-control" type="text" placeholder="Enter description" name="meta_description"
                                    value="{{ @$data->meta_description }}">
                            </div>
                            <div class="clearfix"></div>
                            <input type="hidden" value="{{ @$data->id }}" name="id">
                            <div class="tp_addpages_btn">
                                <button type="submit" class="tp_btn" id="pages-post-form-btn">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
