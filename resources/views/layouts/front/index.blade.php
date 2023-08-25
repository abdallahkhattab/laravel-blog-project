<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Elzero</title>
    <link rel="stylesheet" href="{{ asset('assets/front/css/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/elzero.css') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/all.min.css') }}" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&display=swap" rel="stylesheet" />
  </head>
  <body>
    <!-- Start Header -->
    <div class="header" id="header">
      <div class="container">
        <a href="#" class="logo">Khattab</a>
        <ul class="main-nav">
          <li><a href="#articles">Articles</a></li>
          <li><a href="#gallery">Gallery</a></li>
          <li><a href="#features">Features</a></li>
          <li>
            <a href="#">Other Links</a>
            <!-- Start Megamenu -->
            <div class="mega-menu">
              <div class="image">
                <img src="{{ asset('assets/front/imgs/megamenu.png') }}imgs/megamenu.png" alt="" />
              </div>
              <ul class="links">
                <li>
                  <a href="#testimonials"><i class="far fa-comments fa-fw"></i> Testimonials</a>
                </li>
                <li>
                  <a href="#team"><i class="far fa-user fa-fw"></i> Team Members</a>
                </li>
                <li>
                  <a href="#services"><i class="far fa-building fa-fw"></i> Services</a>
                </li>
                <li>
                  <a href="#our-skills"><i class="far fa-check-circle fa-fw"></i> Our Skills</a>
                </li>
                <li>
                  <a href="#work-steps"><i class="far fa-clipboard fa-fw"></i> How It Works</a>
                </li>
              </ul>
              <ul class="links">
                <li>
                  <a href="#events"><i class="far fa-calendar-alt fa-fw"></i> Events</a>
                </li>
                <li>
                  <a href="#pricing"><i class="fas fa-server fa-fw"></i> Pricing Plans</a>
                </li>
                <li>
                  <a href="#video"><i class="far fa-play-circle fa-fw"></i> Top Videos</a>
                </li>
                <li>
                  <a href="#stats"><i class="far fa-chart-bar fa-fw"></i> Stats</a>
                </li>
                <li>
                  <a href="#discount"><i class="fas fa-percent fa-fw"></i> Request A Discount</a>
                </li>
              </ul>
            </div>
            <!-- End Megamenu -->
          </li>
        </ul>
      </div>
    </div>
    <!-- End Header -->
    <!-- Start Landing -->
    <div class="landing">
      <div class="container">
        <div class="text">
          <h1>Welcome, To Khattab World</h1>
          <p>Here Iam gonna share everything about my life. Books Iam reading, Games Iam Playing, Stories and Events</p>
        </div>
        <div class="image">
          <img src="{{ asset('assets/front/imgs/landing-image.png') }}" alt="" />
        </div>
      </div>
      <a href="#articles" class="go-down">
        <i class="fas fa-angle-double-down fa-2x"></i>
      </a>
    </div>
    
    <!-- End Landing -->
    <!-- Start Articles -->
    <div class="articles" id="articles">
      <h2 class="main-title">Articles</h2>
      <div class="container">
          @foreach ($articles as $article)
              <div class="box">
                  <img src="{{ asset('storage/images/' . $article->image) }}" alt="" />
  
                  <div class="content">
                      <h3>{{ $article->title_en }}</h3>
                      <p>{{ $article->description_en }}</p>
                  </div>
                  <div class="info">
                      <a href="#">Read More</a>
                      <i class="fas fa-long-arrow-alt-right"></i>
                  </div>
  
                  <!-- Comment section -->
                  <p class="d-inline-flex p-2">Comments</p>
  
                  <div class="comments-section">
                      @foreach ($article->comments as $comment)
                          <div class="comment mb-4">
                              <div class="d-flex align-items-start">
                                  <div class="comment-content">
                                      <div class="comment-header">
                                          <span class="comment-user d-flex p-2">{{ $comment->user->name }} : {{ $comment->content }}</span>
                                      </div>
                                      <div class="comment-time">{{ $comment->created_at->diffForHumans() }}</div>
                                  </div>
                              </div>
                          </div>
                      @endforeach
  
                      <!-- Comment form -->
                      <form action="{{ route('dashboard.comments.store', $article->id) }}" method="post">
                          @csrf
                          <div class="mb-3">
                              <textarea class="form-control" name="content" rows="3" placeholder="Add your comment"></textarea>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit Comment</button>
                      </form>
                  </div>
  
                  <!-- Like/Unlike buttons -->
                  @auth
                  @if(!$article->likes->contains('user_id', auth()->user()->id))
                      <form method="POST" action="{{ route('dashboard.articles.like', ['article' => $article->id]) }}">
                          @csrf
                          <button type="submit" class="btn" >
                              <i class="far fa-thumbs-up"></i>
                          </button>
                      </form>
                  @else
                      <form method="POST" action="{{ route('dashboard.articles.unlike', ['article' => $article->id]) }}">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn">    <i class="fa fa-thumbs-up text-danger" aria-hidden="true"></i>
                          </i>
                          </button>
                      </form>
                  @endif
              @endauth
              
              </div>
          @endforeach
      </div>
  
      <div class="d-flex justify-content-center py-3">
          {{ $articles->links() }}
      </div>
  </div>
  
  
  
  
  
    
    <div class="spikes"></div>
    <!-- End Articles -->
    <!-- Start Gallery -->
    <div class="gallery" id="gallery">
      <h2 class="main-title">Gallery</h2>
      <div class="container">
        <div class="box">
          <div class="image">
            <img src="{{ asset('assets/front/imgs/gallery-01.png') }}" alt="" />
          </div>
        </div>
        <div class="box">
          <div class="image">
            <img src="{{ asset('assets/front/imgs/gallery-02.png') }}" alt="" />
          </div>
        </div>
        <div class="box">
          <div class="image">
            <img src="{{ asset('assets/front/imgs/gallery-03.jpg') }}" alt="" />
          </div>
        </div>
        <div class="box">
          <div class="image">
            <img src="{{ asset('assets/front/imgs/gallery-04.png') }}" alt="" />
          </div>
        </div>
        <div class="box">
          <div class="image">
            <img src="{{ asset('assets/front/imgs/gallery-04.png') }}" alt="" />
          </div>
        </div>
        <div class="box">
          <div class="image">
            <img src="{{ asset('assets/front/imgs/gallery-05.jpg') }}" alt="" />
          </div>
        </div>
      </div>
    </div>
    <!-- End Gallery -->
    <!-- Start Features -->
    <div class="features" id="features">
        <h2 class="main-title">Features</h2>
        <div class="container">
            @foreach ($features as $feature)
                <div class="box">
                    <!-- Use asset() function to construct the URL to the uploaded image -->
                    <div class="img-holder"><img src="{{ asset('storage/images/' . $feature->image) }}" alt="" /></div>
                    <h2>{{ $feature->title_en }}</h2>
                    <p>{{ $feature->description_en }}</p>
                    <a href="#">More</a>
                </div>
                @endforeach

        </div>
    </div>

    </div>

  </div>
    
    <!-- End Features -->
    <!-- Start Testimonials -->
    <div class="testimonials" id="testimonials">
      <h2 class="main-title">Testimonials</h2>
      <div class="container">
        @foreach($testimonials as $testemonial)
        <div class="box">
          <div class="img-holder"><img src="{{ asset('storage/images/' . $testemonial->avatar) }}" alt="" /></div>
          <h3>{{ $testemonial->name_en }}</h3>
          <span class="title">{{ $testemonial->title_job_en }}</span>
          <div class="rate">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $testemonial->rate)
                    <i class="filled fas fa-star"></i>
                @else
                    <i class="far fa-star"></i>
                @endif
            @endfor
        </div>
          <p>
           {{ $testemonial->description_en }}
          </p>
        </div>
        @endforeach
      </div>
    </div>
    <!-- End Testimonials -->
    <!-- Start Team -->
    <div class="team" id="team">
      <h2 class="main-title">Team Members</h2>
      <div class="container">
        @foreach ($teamMembers as $member )
          
        <div class="box">
          <div class="data">
            <img src="{{ asset('storage/images/' . $member->image) }}" alt="" />
            <div class="social">
              <a href="{{ $member->facebook }}">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="{{ $member->twitter }}">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="{{ $member->linkedin }}">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a href="{{ $member->youtube }}">
                <i class="fab fa-youtube"></i>
              </a>
            </div>
          </div>
          <div class="info">
            <h3>{{ $member->name_en }}</h3>
            <p>{{ $member->description_en }}</p>
          </div>
        </div>
        @endforeach


        
      </div>

    </div>
    <div class="spikes"></div>
    <!-- End Team -->
    <!-- Start Services -->
    <div class="services" id="services">
      <h2 class="main-title">Services</h2>
      <div class="container">
        @foreach ($services as $service )
          
        <div class="box">
          <i class="fas fa-user-shield fa-4x"></i>
          <h3>{{ $service->name_en }}</h3>
          <div class="info">
            <a href="#">Details</a>
          </div>
        </div>
     
        @endforeach

      </div>
      
    </div>

    </div>
    <!-- End Services -->
    <!-- Start Skills -->
    <div class="our-skills" id="our-skills">
      <h2 class="main-title">Our Skills</h2>
      <div class="container">
        <img src="{{ asset('assets/dashboard/front/imgs/skills.png') }}" alt="" />
        <div class="skills">
          <div class="skill">
            <h3>HTML <span>80%</span></h3>
            <div class="the-progress">
              <span style="width: 0" data-width="80%"></span>
            </div>
          </div>
          <div class="skill">
            <h3>CSS <span>85%</span></h3>
            <div class="the-progress">
              <span style="width: 0" data-width="85%"></span>
            </div>
          </div>
          <div class="skill">
            <h3>JavaScript <span>70%</span></h3>
            <div class="the-progress">
              <span style="width: 0" data-width="70%"></span>
            </div>
          </div>
          <div class="skill">
            <h3>Python <span>80%</span></h3>
            <div class="the-progress">
              <span style="width: 0" data-width="80%"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Skills -->
    <!-- Start Work Steps -->
    <div class="work-steps" id="work-steps">
      <h2 class="main-title">How It Works ?</h2>
      <div class="container">
        <img src="{{ asset('assets/frontimgs/work-steps.png') }}" alt="" class="image" />
        <div class="info">
          <div class="box">
            <img src="{{ asset('assets/front/imgs/work-steps-1.png') }}" alt="" />
            <div class="text">
              <h3>Business Analysis</h3>
              <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim nesciunt obcaecati quisquam quis laborum
                recusandae debitis vel
              </p>
            </div>
          </div>
          <div class="box">
            <img src="{{ asset('assets/front/imgs/work-steps-2.png') }}" alt="" />
            <div class="text">
              <h3>Architecture</h3>
              <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim nesciunt obcaecati quisquam quis laborum
                recusandae debitis vel
              </p>
            </div>
          </div>
          <div class="box">
            <img src="{{ asset('assets/front/imgs/work-steps-3.png') }}" alt="" />
            <div class="text">
              <h3>Developement</h3>
              <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Enim nesciunt obcaecati quisquam quis laborum
                recusandae debitis vel
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
   
    <!-- End Events -->
    <!-- Start Pricing -->
    <div class="pricing" id="pricing">
      <div class="dots dots-up"></div>
      <div class="dots dots-down"></div>
      <h2 class="main-title">Pricing Plans</h2>
      <div class="container">
        @foreach ($plans as $plan )
          
        <div class="box">
          <div class="title">{{ $plan->title_en }}</div>
          <img src="imgs/hosting-basic.png" alt="" />
          <div class="price">
            <span class="amount">${{ $plan->price }}</span>
            <span class="time">{{ $plan->title_time_en }}</span>
          </div>
          <ul>
            <li>{{ $plan->hdd_en }}</li>
            <li>{{ $plan->email_num }}</li>
            <li>{{ $plan->subdomain_num }}</li>
            <li>{{ $plan->database_num }}</li>
            <li>{{ $plan->support_type }}</li>
          </ul>
          <a href="#">Choose Plan</a>
        </div>
        @endforeach
      </div>

    </div>
    <!-- End Pricing -->
    <!-- Start Videos -->
    <div class="videos" id="videos">
      <h2 class="main-title">Top Videos</h2>
      <div class="container">
        <div class="holder">
          <div class="list">
            <div class="name">
              Top Videos
              <i class="fas fa-random"></i>
            </div>
            <ul>
              <li>How To Create Sub Domain<span>05:18</span></li>
              <li>Playing With The DNS <span>03:18</span></li>
              <li>Everything About The Virtual Hosts <span>05:25</span></li>
              <li>How To Monitor Your Website <span>04:16</span></li>
              <li>Uncharted Beating The Last Boss <span>07:48</span></li>
              <li>Ys Oath In Felghana Overview <span>03:12</span></li>
              <li>Ys Series All Games Ending <span>08:10</span></li>
            </ul>
          </div>
          <div class="preview">
            <img src="{{ asset('assets/front/imgs/video-preview.jpg') }}" alt="" />
            <div class="info">Everything About The Virtual Hosts</div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Videos -->
    <!-- Start Stats -->
    <div class="stats" id="stats">
      <h2>Our Awesome Stats</h2>
      <div class="container">
        <div class="box">
          <i class="far fa-user fa-2x fa-fw"></i>
          <span class="number" data-goal="150">0</span>
          <span class="text">Clients</span>
        </div>
        <div class="box">
          <i class="fas fa-code fa-2x fa-fw"></i>
          <span class="number" data-goal="135">0</span>
          <span class="text">Projects</span>
        </div>
        <div class="box">
          <i class="fas fa-globe-asia fa-2x fa-fw"></i>
          <span class="number" data-goal="50">0</span>
          <span class="text">Countries</span>
        </div>
        <div class="box">
          <i class="far fa-money-bill-alt fa-2x fa-fw"></i>
          <span class="number" data-goal="500">0</span>
          <span class="text">Money</span>
        </div>
      </div>
    </div>
    <!-- End Stats -->
    <!-- Start Discount -->
    <div class="discount" id="discount">
      <div class="image">
        <div class="content">
          <h2>We Have A Discount</h2>
          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Excepturi asperiores consectetur, recusandae
            ratione provident necessitatibus, cumque delectus commodi fuga praesentium beatae. Totam vel similique
            laborum dicta aperiam odit doloribus corporis.
          </p>
          <img src="imgs/discount.png" alt="" />
        </div>
      </div>
      <div class="form" >
        <div class="content">
          <h2>Request A Discount</h2>
          @if ($errors->any())
          <div class="alert alert-danger" role="alert">
        
                      <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div>  
      @endif
      
          <form action="{{ route('form1') }}" method="POST" id="myForm">
            @csrf
            <input class="input" type="text" placeholder="Your Name" name="name" value="{{old('name')  }}" />
            <input class="input" type="email" placeholder="Your Email" name="email" value="{{ old('email') }}" />
            <input class="input" type="text" placeholder="Your Phone" name="mobile" />
            <textarea class="input" placeholder="Tell Us About Your Needs" name="message"></textarea>
            <input type="submit" value="Send" />
          </form>
        </div>
      </div>
    </div>
    <!-- End Discount -->
    <!-- Start Footer -->
    <div class="footer">
      <div class="container">
        <div class="box">
          <h3>Elzero</h3>
          <ul class="social">
            <li>
              <a href="#" class="facebook">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li>
              <a href="#" class="twitter">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li>
              <a href="#" class="youtube">
                <i class="fab fa-youtube"></i>
              </a>
            </li>
          </ul>
          <p class="text">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Temporibus nulla rem, dignissimos iste aspernatur
          </p>
        </div>
        <div class="box">
          <ul class="links">
            <li><a href="#">Important Link 1</a></li>
            <li><a href="#">Important Link 2</a></li>
            <li><a href="#">Important Link 3</a></li>
            <li><a href="#">Important Link 4</a></li>
            <li><a href="#">Important Link 5</a></li>
          </ul>
        </div>
        <div class="box">
          <div class="line">
            <i class="fas fa-map-marker-alt fa-fw"></i>
            <div class="info">Egypt, Giza, Inside The Sphinx, Room Number 220</div>
          </div>
          <div class="line">
            <i class="far fa-clock fa-fw"></i>
            <div class="info">Business Hours: From 10:00 To 18:00</div>
          </div>
          <div class="line">
            <i class="fas fa-phone-volume fa-fw"></i>
            <div class="info">
              <span>+20123456789</span>
              <span>+20198765432</span>
            </div>
          </div>
        </div>
        <div class="box footer-gallery">
          <img src="imgs/gallery-01.png" alt="" />
          <img src="imgs/gallery-02.png" alt="" />
          <img src="imgs/gallery-03.jpg" alt="" />
          <img src="imgs/gallery-04.png" alt="" />
          <img src="imgs/gallery-05.jpg" alt="" />
          <img src="imgs/gallery-06.png" alt="" />
        </div>
      </div>
      <p class="copyright">Made With &lt;3 By Elzero</p>
    </div>
    <!-- End Footer -->
    <script src="{{ asset('assets/front/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>

<script>
  $(document).ready(function() {
      $('.like-button').on('click', function() {
          var form = $(this).closest('.like-form');
          var articleId = form.data('article');
  
          $.ajax({
              url: '/articles/' + articleId + '/like',
              type: 'POST',
              data: form.serialize(),
              success: function(response) {
                  form.find('.like-button').toggleClass('active');
                  form.siblings('.unlike-form').find('.unlike-button').removeClass('active');
              },
              error: function(error) {
                  console.error(error);
              }
          });
      });
  
      $('.unlike-button').on('click', function() {
          var form = $(this).closest('.unlike-form');
          var articleId = form.data('article');
  
          $.ajax({
              url: '/articles/' + articleId + '/unlike',
              type: 'POST',
              data: form.serialize(),
              success: function(response) {
                  form.find('.unlike-button').toggleClass('active');
                  form.siblings('.like-form').find('.like-button').removeClass('active');
              },
              error: function(error) {
                  console.error(error);
              }
          });
      });
  });
  </script>
  

  </body>
</html>
