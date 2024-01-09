<?php 
$ASSET_URL = asset('user-theme').'/';
$setting = getsetting(); 
?>

<?php $__env->startSection('content'); ?>
   <div>
<div style="margin-left: 30px; margin-right: 30px; height: 300px; background-image: url('<?php echo e($ASSET_URL); ?>assets/images/my_images/images/product-banner.jpg'); background-position: center;">

    <div style="display: block;  padding: 30px; color: #fff; border-radius: 10px; position: relative; width: 100%;">
        <div style="display: flex; flex-wrap: wrap; box-sizing: border-box;">
            <div style="flex: 1 0 100%; max-width: 100%; padding-right: 15px; padding-left: 15px; box-sizing: border-box;">

                <div style="height: 300px; box-sizing: border-box; margin-top: 30px;">
<h3> Blogs </h3>                    <div style="font-size: 16px; font-weight: 600; margin-top: 0px; margin-bottom: 16px; width: 50%; word-wrap: break-word;"><?php echo @$product->short_desc; ?></div> 

                        <span style="margin-top: 20px; font-size: 16px; display: block; font-weight: 300;">Get the job you deserve with a powerful, interview-winning resume.</span>
                    </p>
                </div>
            </div>
        </div>
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
</head>
<body>

  <div class="container-fluid blog-container">
    <div class="row">

      <!-- Blog Grid -->
      <div class="col-md-9 blog-row">

        <!-- Blog Items -->
        <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <div class="blog-column">
          <div class="blog-item">
          <a href="<?php echo e(route('frontend.blogs.show', ['slug' => $blog->slug])); ?>">
            <img src="<?php echo e(asset('storage/' . $blog->image)); ?>" alt="Blog Image" class="blog-img">
            <div class="blog-item-content bg-white p-4">
<div class="blog-item-meta  py-1 px-2">
					<span class="text-muted text-capitalize mr-3"><i class="bi bi-pencil-square mr-2"></i><?php echo e($blog->category->name); ?></span>
				</div> 
                <h4 class="mt-3 mb-3"><?php echo e($blog->name); ?></h4>
           <p class="mb-4"><?php echo Str::limit(strip_tags($blog->description), 150); ?></p>
</a>
            				<a href="blog-single.html" class="btn btn-small btn-main btn-round-full">Learn More</a>

          </div>
        </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     
    <!-- Pagination Links -->
    <div class="pagination mt-4">
        <?php echo e($blogs->links()); ?>

    </div>
      </div>

      <!-- Sidebar for Recent Posts -->
<div class="col-md-4 sidebar">
    <div class="searchblogs">
        <div class="sidebar-widget search card p-4 mb-3 border-0">
            <form action="<?php echo e(route('frontend.blogs.index')); ?>" method="GET">
                <input type="text" name="search" class="form-control" placeholder="Search">
                <button type="submit" class="btn btn-mian btn-small d-block mt-2">Search</button>
            </form>
        </div>
    </div>
           <div class="recentblogs">
        <h4>Recent Posts</h4>
        <ul>
          <?php $__currentLoopData = $recentPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="recent-post-item border-bottom py-3">
                      <a href="<?php echo e(route('frontend.blogs.show', ['slug' => $blog->slug])); ?>">
                <img src="<?php echo e(asset('storage/' . $blog->image)); ?>" alt="Recent Post Image" class="recent-post-img">         
            <div class="media-body">
                <h6 class="my-2 font-weight-bold"><a href="<?php echo e(route('frontend.blogs.show', ['slug' => $blog->slug])); ?>"><?php echo e($blog->name); ?></a></h6></a>
                <span class="text-sm text-muted"><?php echo e($blog->created_at->format('d-M-Y')); ?></span>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            </li>
        </div>
        </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS and jQuery (you may need to include these) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--===Contactus Section End===-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('user-theme/my_assets/js/validation.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newway\resources\views/frontend/blogs/index.blade.php ENDPATH**/ ?>