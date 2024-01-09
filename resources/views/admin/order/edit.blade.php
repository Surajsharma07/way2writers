@php $price_symbol = getSetting()->default_symbol ?? '$'; @endphp
@php $ASSET_URL = asset('admin-theme').'/'; @endphp
@extends('admin.layouts.app')
@section('content')
    <div class="tp_main_content_wrappo">
        <div class="tp_tab_wrappo">
            <ul>
                <li><a href="{{ route('admin.order.index') }}">Order List</a> </li>
            </ul>
        </div>
        <div class="tp_tab_content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="tp_catset_box tp_catset_singleuser">
                        <div role="tabpanel" class="tab-pane active" id="info">
                            
                            <h3>update Order Details</h3>
                            <hr>
                            <div class="table-responsive">
                                <table id="example" class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                              <th>Status</th>
                                              <th>File</th>
                                        </tr>
                                    </thead>
                   
<form id="order_updsate_form" method="POST" action="{{ route('admin.order.update', $data->id) }}" enctype="multipart/form-data">    @csrf
    @method('PATCH')
    <tbody>
            @if (@$data->getOrderProduct)
            @php $productCounter = 0; @endphp
            @foreach ($data->getOrderProduct as $key => $items2)
                @foreach ($items2->getProduct as $key3 => $item3)
                        @php
                            $variants = !empty($items2->variants) ? unserialize($items2->variants) : null;
                            $hasVariants = !empty($variants);
                            $variantCounter = 0; // Reset variant counter for each product
                        @endphp

                        @if ($hasVariants)
                            @foreach ($variants as $v_items)
                                <tr>
                                    <!-- Add other table data -->
                                    <td>{{ ++$variantCounter }}</td>
                                    <td>{{ $item3->name . ' ' . $v_items['option_name'] }}</td>
                                        <!-- Dropdown for order status -->
                                        <td>
                       <select class="form-control" name="status[{{ $items2->id }}]" id="status_{{ $items2->id }}">
    <option value="pending" {{ $items2->resumeStatus == 'pending' ? 'selected' : '' }}>Pending</option>
    <option value="processing" {{ $items2->resumeStatus == 'processing' ? 'selected' : '' }}>Processing</option>
    <option value="completed" {{ $items2->resumeStatus == 'completed' ? 'selected' : '' }}>Completed</option>
</select>
                                    </td>
                               <td>
    <!-- File upload for main product -->
    <div class="file-upload">
        <input type="file" name="main_product_file[{{ $items2->id }}]" id="main_product_file_{{ $items2->id }}" style="display: none;">
        <label for="main_product_file_{{ $items2->id }}">
            @if($items2->file_upload_path)
                <a href="{{ asset($items2->file_upload_path) }}" target="_blank">Download Resume</a>
            @else
                Upload Main File
            @endif
        </label>
        @if($items2->file_upload_path)
            <button type="button" class="btn btn-secondary" onclick="uploadAgain('main_product_file_{{ $items2->id }}')">Upload Again</button>

        @endif
    </div>
</td>
                                </tr>
                                <!-- Display the cover letter in a separate row -->
                                @if ($items2->include_cover_letter)
                                    <tr>
                                        <td>{{ ++$variantCounter }}</td>
                                        <td>Cover Letter</td>
                                        <td>
                                            <!-- Dropdown for cover letter status -->
                            <select class="form-control" name="cover_letter_status[{{ $items2->id }}]" id="cover_letter_status_{{ $items2->id }}">
        <option value="pending" {{ $items2->cover_letter_status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="processing" {{ $items2->cover_letter_status == 'processing' ? 'selected' : '' }}>Processing</option>
        <option value="completed" {{ $items2->cover_letter_status == 'completed' ? 'selected' : '' }}>Completed</option>
    </select>
                                        </td>
                                       <td>
        @if ($items2->cover_letter_path)
            {{-- Display a link to the uploaded cover letter file --}}
                <a href="{{ asset($items2->cover_letter_path) }}" target="_blank">Download Cover Letter</a>
            {{-- Display an "Upload Again" button --}}
            <button type="button" class="btn btn-secondary" onclick="uploadAgain('main_product_file_{{ $items2->id }}')">Upload Again</button>
                    @else
            {{-- Display the file upload input if no cover letter file is uploaded --}}
            <input type="file" name="cover_letter_file[{{ $items2->id }}]" id="cover_letter_file_{{ $items2->id }}">
        @endif
    </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <!-- Add other table data -->
                                <td>{{ ++$productCounter }}</td>
                                <td>{{ $item3->name }}</td>
                      
                                    <!-- Dropdown for order status -->
                                   <select class="form-control" name="status[{{ $items2->id }}]" id="status_{{ $items2->id }}">
    <option value="pending" {{ $items2->resumeStatus == 'pending' ? 'selected' : '' }}>Pending</option>
    <option value="processing" {{ $items2->resumeStatus == 'processing' ? 'selected' : '' }}>Processing</option>
    <option value="completed" {{ $items2->resumeStatus == 'completed' ? 'selected' : '' }}>Completed</option>
</select>

                                </td>
                               <td>
    @if ($items2->file_upload_path)
        {{-- Display a link to the uploaded main file --}}
        <div>
            <a href="{{ asset($items2->file_upload_path) }}" target="_blank">Download Main File</a>
        </div>
        {{-- Display an "Upload Again" button --}}
        <div>
            <button type="button" class="btn btn-secondary" onclick="uploadAgain('main_product_file_{{ $items2->id }}')">Upload Again</button>
        </div>
    @else
        {{-- Display the file upload input if no file is uploaded --}}
        <input type="file" name="main_product_file[{{ $items2->id }}]" id="main_product_file_{{ $items2->id }}">
    @endif
</td>
                            </tr>
                            <!-- Display the cover letter in a separate row -->
                            @if ($items2->include_cover_letter)
                                <tr>
                                    <td>{{ ++$productCounter }}</td>
                                    <td>Cover Letter</td>
                                    <td>
                                        <!-- Dropdown for cover letter status -->
                                        <select class="form-control" name="cover_letter_status[]" id="cover_letter_status_{{ $items2->id }}">
                                            <option value="pending" {{ $items2->cover_letter_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $items2->cover_letter_status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="completed" {{ $items2->cover_letter_status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                    </td>
                                      <td>
        @if ($items2->cover_letter_path)
            {{-- Display a link to the uploaded cover letter file --}}
            <div>
                <a href="{{ asset($items2->cover_letter_path) }}" target="_blank">Download Cover Letter</a>
            </div>
            {{-- Display an "Upload Again" button --}}
            <div>
            <button type="button" class="btn btn-secondary" onclick="uploadAgain('main_product_file_{{ $items2->id }}')">Upload Again</button>
            </div>
        @else
            {{-- Display the file upload input if no cover letter file is uploaded --}}
            <input type="file" name="cover_letter_file[{{ $items2->id }}]" id="cover_letter_file_{{ $items2->id }}">
        @endif
        
    </td>


   
                                </tr>
                            @endif
                        @endif
                    @endforeach
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">No Record Found.</td>
                </tr>
            @endif
 <tr>
            <td colspan="6" class="text-right">
     <button type="submit" id="order_update_form" class="btn btn-primary">Submit</button>            </td>
        </tr>
    </tbody>
</form>    </table>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('admin-theme/my_assets/js/form-validate.js') }}"></script>
@endsection