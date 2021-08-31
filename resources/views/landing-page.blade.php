<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <title>Mosharek</title>
</head>
<body>
<!-- start of header -->
<header>
    <navigation>
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="{{route('landing')}}"><img src="{{asset('img/logo.png')}}" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">خدماتنا</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">من نحن</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#prices">خطة الاسعار</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0 ">
                <a href="{{route('admin.home')}}" class="btn login-btn  my-2 my-sm-0" type="submit">تسجيل الدخول</a>
                <a href="{{route('admin.register')}}" class="btn  inroll-btn my-2 my-sm-0" type="submit">اشترك الان</a>
{{--                <button class="btn  inroll-btn my-2 my-sm-0" type="submit">اشترك الان</button>--}}
              </form>
            </div>
          </nav>
    </navigation>
<div class="container header-text">
    <div class="row">
        <div class="col-md-6">
            <div class="main-text">
                <h1>المساعد الأول <br> لإدارة النوادي الرياضية</h1>
                <p>برنامج متخصص في كل ما يخص إدارة النوادي الرياضية و متابعة التمارين  و تطور أداء اللاعبين وتتبع المدفوعات</p>
                <a href="{{route('admin.register')}}" class="btn  order-btn" type="submit">اشترك الان</a>

            </div>
        </div>
        <div class="col-md-6"></div>
    </div>
</div>

<div class="header-background">
    <!-- <img src="img/ILLUSTRATION1.svg" alt=""> -->
</div>

</header>
<!-- end of header -->
<!-- start of about us -->
<div class="about" id="about">
  <div class="container">
    <div class="row">
      <div class="col-md-12 p-5">
        <p class="question">من نحن ..؟</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="about-card">
          <div class="card-logo">
            <img src="img/manage.svg" alt="manage">
          </div>
          <div class="card-description">
            <h4>إدارة الفريق</h4>
            <p>تسجيل وإدارة اللاعبين واولياء الأمور و التعاون مع زملاء العمل</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="about-card">
          <div class="card-logo">
            <img src="img/tracking.svg" alt="manage">
          </div>
          <div class="card-description">
            <h4>متابعة أداء اللاعبين</h4>
            <p>أنشئ خططًا للموسم و تتبع أي شيء مهم للاعبيك و احصل على نظرة عامة للنتائج</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="about-card">
          <div class="card-logo">
            <img src="img/payment.svg" alt="manage">
          </div>
          <div class="card-description">
            <h4>ارسال وتتبع المدفوعات</h4>
            <p>إعداد وإرسال الفواتير للاعبين في دقائق و تتبع المدفوعات و استيراد كشف الحساب المصرفي</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="about-card">
          <div class="card-logo">
            <img src="img/contact.svg" alt="manage">
          </div>
          <div class="card-description">
            <h4>سهولة التواصل</h4>
            <p>الوصول إلى اللاعبين وأولياء الأمور من خلال رسائل مخصصة أو إرسال إشعارات التطبيقات</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end of about -->
<!-- start of perfect-manging -->
<div class="perfect-manging">
  <div class="container">
    <div class="row">
      <div class="col-md-6 p-0">
        <div class="manging-img">

        </div>
      </div>
      <div class="col-md-6 pt-5">
        <h2>الأداة المثالية للتنظيم والإدارة</h2>
        <ul>
          <li><img src="img/checked.svg" alt="cheched"><span>وفر وقت التخطيط و تحليل النتائج و تجميع بيانات الفريق ، وتوصيل رسائل وأخبار الجدول الزمني</span></li>
          <li><img src="img/checked.svg" alt="cheched"><span>اعرف أين يتفوق لاعبوك أو لماذا لا يؤدون بشكل جيد و تجنب الإفراط في التدريب والإصابات</span></li>
          <li><img src="img/checked.svg" alt="cheched"><span>يمكنك انشاء الجداول بسهوله ومشاركتها مع اللاعبين أو أولياء الأمور أو على موقع الويب الخاص بك</span></li>
          <li><img src="img/checked.svg" alt="cheched"><span>قم بتثقيف الآباء حول الرياضة وثقافة ناديك و معرفة كيف يتقدم أطفالهم</span></li>
        </ul>
{{--        <button class="btn order-btn" type="submit">طلب عرض الان</button>--}}
      </div>
    </div>
  </div>
</div>
<!-- end of perfect-manging -->
<!-- start of achivments -->
<div class="achivments p-5" id="achivments">
  <div class="container">
    <div class="row">
    <div class="col-md-12 p-4">
      <p class="our-achivement">انجازاتنا</p>
    </div>
    </div>
    <div class="row">
      <div class="col-md-4 main-achiev">
        <div class="achivment-card">
          <p class="number"><span>+</span>6000</p>
          <p>مدرب</p>
        </div>
      </div>
      <div class="col-md-4 main-achiev">
        <div class="achivment-card ">
          <p class="number"><span>+</span>54000</p>
          <p>رياضى</p>
        </div>
      </div>
      <div class="col-md-4 main-achiev">
        <div class="achivment-card">
          <p class="number"><span>+</span>25000</p>
          <p>تمرين</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end of achivments -->
<!-- start of prices -->
<div class="prices" id="prices">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p class="price-role">خطة الاسعار</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="price-card">
          <p class="main-title">محترف</p>
          <div class="price">
            <p>١٢٠ ريال / شهر</p>
          </div>
          <div class="card-achivments">
            <ul>
              <li><img src="img/checked.svg" alt="cheched"><span>هذا النص هو مثال لنص يمكن أن يستبدل نفس المساحة</span></li>
              <li><img src="img/checked.svg" alt="cheched"><span>هذا النص هو مثال</span></li>
              <li><img src="img/checked.svg" alt="cheched"><span>هذا النص هو مثال لنص يمكن أن يستبدل</span></li>
              <li><img src="img/cancel.svg" alt="cheched"><span>هذا النص هو مثال</span></li>
              <li><img src="img/cancel.svg" alt="cheched"><span>هذا النص هو مثال</span></li>
            </ul>
          </div>
          <button class="btn inroll-btn" type="submit">اشترك الان</button>
        </div>
      </div>
      <div class="col-md-4">
        <div class="price-card">
          <p class="main-title">محترف</p>
          <div class="price">
            <p>١٢٠ ريال / شهر</p>
          </div>
          <div class="card-achivments">
            <ul>
              <li><img src="img/checked.svg" alt="cheched"><span>هذا النص هو مثال لنص يمكن أن يستبدل نفس المساحة</span></li>
              <li><img src="img/checked.svg" alt="cheched"><span>هذا النص هو مثال</span></li>
              <li><img src="img/checked.svg" alt="cheched"><span>هذا النص هو مثال لنص يمكن أن يستبدل</span></li>
              <li><img src="img/cancel.svg" alt="cheched"><span>هذا النص هو مثال</span></li>
              <li><img src="img/cancel.svg" alt="cheched"><span>هذا النص هو مثال</span></li>
            </ul>
          </div>
          <button class="btn inroll-btn" type="submit">اشترك الان</button>
        </div>
      </div>
      <div class="col-md-4">
        <div class="price-card">
          <p class="main-title">محترف</p>
          <div class="price">
            <p>١٢٠ ريال / شهر</p>
          </div>
          <div class="card-achivments">
            <ul>
              <li><img src="img/checked.svg" alt="cheched"><span>هذا النص هو مثال لنص يمكن أن يستبدل نفس المساحة</span></li>
              <li><img src="img/checked.svg" alt="cheched"><span>هذا النص هو مثال</span></li>
              <li><img src="img/checked.svg" alt="cheched"><span>هذا النص هو مثال لنص يمكن أن يستبدل</span></li>
              <li><img src="img/cancel.svg" alt="cheched"><span>هذا النص هو مثال</span></li>
              <li><img src="img/cancel.svg" alt="cheched"><span>هذا النص هو مثال</span></li>
            </ul>
          </div>
          <button class="btn inroll-btn" type="submit">اشترك الان</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end of prices -->
<!-- footer -->
<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center footer-info">
        <h1>ترغب في تجربة البرنامج؟</h1>
        <p>اشترك الان وتمتع بتجربة مجانية كاملة للبرنامج</p>
        <button class="btn order-btn" type="submit">طلب عرض الان</button>
      </div>
    </div>
    <div class="row pt-4" style="border-bottom:  3px solid #F5F7FE;;">
      <div class="col-md-6 logo">
        <img src="img/logo.png" alt="">
      </div>
      <div class="col-md-6 text-left">
        <div class="sociel-icons">
          <ul>
            <li><img src="img/in.svg" alt=""></li>
            <li><img src="img/t.svg" alt=""></li>

            <li><img src="img/f.svg" alt=""></li>


          </ul>
        </div>
      </div>
    </div>
    <div class="row p-4">
      <div class="col-md-12 text-center">
        <p class="copy-right">Copyrights© 2021 Devest company</p>
      </div>
    </div>
  </div>
</div>
<!-- end of footer -->
<script src="js/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
crossorigin="anonymous"></script>
 <script src="js/all.min.js"></script>
 <script src="js/app.js"></script>
</body>
</html>
