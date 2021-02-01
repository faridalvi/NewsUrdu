<!-- Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="embed-container">
                    <iframe class="popup-iframe" src=""  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="navbar-dark mt-3">
   <div class="container">
       <div class="row flex-row-reverse py-3">
            <div class="col-md-4 footer-logo">
                <h3 class="">9نیوزایچ ڈی</h3>
                <a href="{{route('main')}}">
                    <img src="{{asset('front/img/logo.png')}}" alt="">
                </a>
            </div>
           <div class="col-md-4 footer-logo">
               <h3 class="">ہمارےبارےمیں</h3>
               <p>9نیوزایچ ڈی ٹی وی کی آفیشیل اینڈ رائیڈ ایپلیکیشن ۔ 9نیوزایچ ڈی لائیو دیکھئے</p>
           </div>
           <div class="col-md-4 footer-logo">
               <h3 class="">اپنی ای میل کاپتہ لکھو</h3>
               <form action="#">
                   <div class="mb-2">
                       <input type="text" class="form-control form-control-sm rounded-0 border-0 w-75 ms-auto" name="email">
                   </div>
                   <input type="submit" class="btn btn-sm btn-danger">
               </form>
           </div>
       </div>
   </div>
</footer>
