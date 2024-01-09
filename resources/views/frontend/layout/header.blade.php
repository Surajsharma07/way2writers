@php
    $ASSET_URL = asset('user-theme') . '/';
    $auth_user = Auth::user();
    $setting = getsetting();
    $STORAGE_URL = Storage::url('/');
@endphp

<section class="clearfix slideshow-block">
    <article class="banner text-center banner1">			
        <div class="position">
          <div class="make1">
            <div class="clearfix">
                <div class="wd650">
                
                <h4 class="capt"><span class="slid-caption">BOOST YOUR RESUME WITH OUR EXPERTS</span></h4>
                <p class="capt1"><span>Make your resume job-ready with our expert help</span></p>
                </div>
                <a class="nav-link " href="{{ route('frontend.contact-us') }}"><span class="know-more">Free Resume Analysis</span></a>
            </div>
          </div>
        </div>				
    </article>

    <article class="banner text-center banner1">
        <div class="position">
          <div class="make1">
            <div class="clearfix">
                <div class="wd650">
                    <h4 class="capt"><span class="slid-caption">ESTABLISH A STRONG SOCIAL PROFILE</span></h4>
                    <p class="capt1"><span>Build &amp; maintain a broader network</span></p>
                </div>
                <a class="nav-link " href="{{ route('frontend.contact-us') }}"><span class="know-more">Free Resume Analysis</span></a>
            </div>
          </div>                  
        </div>
    </article>
    
    <article class="banner text-center banner1">
        <div class="position">
          <div class="make1">
            <div class="clearfix">
                <div class="wd650">
                    <h4 class="capt"><span class="slid-caption">CREATE A VISUAL STORY OF YOUR CAREER</span></h4>
                    <p class="capt1"><span>Make your resume a powerful presentation of your career story</span></p>
                </div>
                <a class="nav-link " href="{{ route('frontend.contact-us') }}"><span class="know-more">Free Resume Analysis</span></a>
            </div>
          </div>                  
        </div>
    </article>
    
</section>


<div class="contactnow d-none d-md-block">
    <div class="head">NEED HELP</div>
    <ul>
        <li><a href="tel:9599889860"><img src="{{ $ASSET_URL }}assets/images/my_images/images/spacer.gif" class="ico cus-icon cus-call" /> <strong>+91-95998 89860</strong></a></li>
        <li><a href="{{ route('frontend.contact-us') }}"><img src="{{ $ASSET_URL }}assets/images/my_images/images/spacer.gif" class="ico cus-icon cus-call-requ" /> REQUEST A CALLBACK</a></li>
    </ul>
</div>

<div class="gray-left-skew"></div>


             </div>
              </div>
       
            </div>
           