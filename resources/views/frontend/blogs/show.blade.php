@php 
$ASSET_URL = asset('user-theme').'/';
$setting = getsetting(); 
@endphp

@extends('frontend.layout.master')
@section('content')
<div>
    <div style="height: 300px; background-image: url('{{ $ASSET_URL }}assets/images/my_images/images/product-banner.jpg'); background-position: center;">
        <div style="display: block; padding: 30px; color: #fff; border-radius: 10px; position: relative; width: 100%;">
            <h6 class="mt-3 mb-3 text-center"> Blogs </h6>
            <h3 class="mt-3 mb-3 text-center"> {{ $blog->slug }} </h3>
        </div>
    </div>
</div>
<style>
    body {
      background-color: #f8f9fa;
    }

    .blog-container {
      width: 95%;
      margin: 50px auto;
    }

    .blog-item {
      margin-bottom: 0px;
    }

    .blog-img {
      width: 100%;
      height: 250px;
      object-fit: cover;
    }

    .sidebar {
      width: 25%;
      padding: 20px;
  
      color: #block;
      margin-left: 50px;
      /*box-shadow: 5px 10px #888888; */    
       border-radius: 5px 5px 5px 5px;
    }

    .blog-row {
      display: flex;
      flex-wrap: wrap;
justify-content: space-between;
      width: 70%;
    }
    

    .blog-column {
      flex: 0 0 48%; /* Adjust the percentage as needed for smaller screens */
      margin-bottom: 20px;
       box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        border-radius: 5px 5px 5px 5px;
        background:white;
    }

    @media (max-width: 767px) {
      .blog-column {
        flex: 0 0 100%; /* Full width on smaller screens */
      }
      .sidebar {
        width: 100%;
        margin-left: 0;
          
      }
      .btn-round-full {
  border-radius: 50px;
}
.blog-row {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      width: 100%;
    }
    }
     .recent-post-item {
      display: flex;
      align-items: center;
    

    }
.recentblogs{
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        border-radius: 5px 5px 5px 5px;
        background:white;
        padding:20px;


}
.searchblogs{
box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        border-radius: 5px 5px 5px 5px;
        background:white;}

    .recent-post-img {
      width: 65px; /* Adjust the size as needed */
      height: 55px;
      object-fit: cover;
      margin-right: 10px;
    }
    .btn-main, .btn-transparent, .btn-small {
  background: var(--theme-color);
  color: #fff;
  transition: all 0.2s ease;
  margin:  20px 0 0 0;
}

.btn-main:hover, .btn-transparent:hover, .btn-small:hover {
  background: #dd0b0b;
  color: #fff;
      
}
.text-sm {
  font-size: 14px;
}
.font-weight-bold{
    font-weight:600;
}
  </style>
  <div class="container-fluid blog-container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="Blog Image">
                <div class="card-body">
                    <h2 class="card-title">{{ $blog->slug }}</h2>
                    <p class="card-text">{!! $blog->description !!}</p>
                    <p class="card-text"><small class="text-muted">Created at: {{ $blog->created_at->format('d-M-Y') }}</small></p>
                </div>
            </div>
        </div>

        <!-- Sidebar for Recent Posts -->
        <div class="col-md-4 sidebar">
            <div class="searchblogs">
                <!-- Search form ... -->
                <div class="sidebar-widget search card p-4 mb-3 border-0">
                    <form action="{{ route('frontend.blogs.index') }}" method="GET">
                        <input type="text" name="search" class="form-control" placeholder="Search">
                        <button type="submit" class="btn btn-mian btn-small d-block mt-2">Search</button>
                    </form>
                </div>
            </div>

            <div class="recentblogs">
                <h4>Recent Posts</h4>
                <ul>
                    @foreach ($recentPosts as $recentPost)
                        <li class="recent-post-item border-bottom py-3">
                            <img src="{{ asset('storage/' . $recentPost->image) }}" alt="Recent Post Image" class="recent-post-img">         
                            <div class="media-body">
                                <h6 class="my-2 font-weight-bold"><a href="{{ route('frontend.blogs.show', ['slug' => $recentPost->slug]) }}">{{ $recentPost->name }}</a></h6>
                                <span class="text-sm text-muted">{{ $recentPost->created_at->format('d-M-Y') }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS and jQuery (you may need to include these) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

@section('scripts')
    <script src="{{asset('user-theme/my_assets/js/validation.js')}}"></script>
@endsection
