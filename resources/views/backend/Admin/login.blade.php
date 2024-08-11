<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin') }}/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/css/demo.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/css/chat_popup.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="{{ asset('backend') }}/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('backend') }}/js/config.js"></script>
    {{-- noman's files --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
    {{-- noman's files --}}
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img height="210px" style="object-fit:cover;" src="{{ asset('backend/img/logo.png') }}" alt="">
                  </span>

                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2 text-center">Sign In</h4>
            @include('error')
              <form id="formAuthentication" class="mb-3"  method="POST">
                {{ csrf_field() }}
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email or username"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="">
                      <small>Forgot Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div class="mb-3">
                  <input class="btn btn-primary d-grid w-100" type="submit" value="Sign In">
                </div>
              </form>

              <p class="text-center">
                <span>New on our platform?</span>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->
    <div class="newBody">
      <!-- btn -->
      <button class="chatbot-toggler">
          <span class="open-chat text-dark">
              <svg width="33px" height="37px" viewBox="0 0 33 37" version="1.1" xmlns="http://www.w3.org/2000/svg"
                   xmlns:xlink="http://www.w3.org/1999/xlink">
                  <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <g id="chat_option_01" transform="translate(-59.000000, -572.000000)">
                          <g id="button_chat_static" transform="translate(46.000000, 559.000000)">
                              <g id="icon_chat" transform="translate(13.000000, 13.000000)">
                                  <path d="M11.3908465,32.1937452 C12.3733449,33.8267185 14.076396,35.4288034 16.5,37 C5.95869323,35.1320625 0.468256843,28.6257901 0.0286908382,17.481183 C0.00965275619,17.1565548 0,16.8294047 0,16.5 C0,16.4339782 0.000387763357,16.3680469 0.00116113687,16.3022084 C0.000387045622,16.2018277 -1.24344979e-14,16.1010916 -1.24344979e-14,16 L0.00728022691,16.0050958 C0.268977109,7.12133202 7.55285045,0 16.5,0 C25.6126984,0 33,7.38730163 33,16.5 C33,25.6126984 25.6126984,33 16.5,33 C14.7167319,33 12.9995375,32.7171051 11.3908465,32.1937452 Z"
                                        id="Combined-Shape-Copy" fill="#274666"></path>
                                  <g id="Group" transform="translate(7.000000, 15.000000)" fill="#FFFFFF">
                                      <circle id="Oval" cx="2" cy="2" r="2"></circle>
                                      <circle id="Oval" cx="9" cy="2" r="2"></circle>
                                      <circle id="Oval" cx="16" cy="2" r="2"></circle>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </g>
              </svg>

              Let's chat!
          </span>

          <span class="material-symbols-outlined text-dark">close</span>
      </button>

      <!-- / btn -->
      <!-- chat bot -->

      <div class="chatbot">
          <header>
              <h4 class="text-dark"><strong>Chat with us</strong></h4>
              <div class="disconnect"></div>
              <span class="close-btn material-symbols-outlined">close</span>
          </header>

          <ul class="chatbox">
              <!-- initial msg -->
              <li class="container incoming beginChatForm" style="list-style: none;">
                  <div class="row">
                      <p class="col-sm-12 py-2">Hi there 👋 Please enter your email below and click Chat to start chatting!</p>
                  </div>
                  <div class="row">
                      <input class="col-sm-12" class="form-control" type="email" id="emailId" name="email"
                             placeholder="Enter email">

                      <div class=" col-sm-12 mt-2 text-center">
                          <button type="button" class="btn btn-info beginChatBtn" onclick="beginChat()">Chat</button>
                      </div>
                  </div>
              </li>

          </ul>

          <div class="chat-input">
              <textarea id="message" placeholder="Enter your message..." spellcheck="false" oninput="actIfHubOffline()" required></textarea>
              <span id="send-btn" class="material-symbols-rounded" onclick="sendMessage()">send</span>
          </div>
      </div>

      <!-- /chat box -->
  </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('admin') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('admin') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('admin') }}/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('admin') }}/assets/js/main.js"></script>

    {{-- noman's files --}}
    <script src="{{ asset('backend') }}/js/signalr.min.js"></script>
    <script src="{{ asset('backend') }}/js/chat_popup.js"></script>
    {{-- / noman's files --}}

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    
    
  </body>
</html>
