@extends('customer.layouts.master')
@push('css')
    <link href="{{ asset('css/customer/home.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('carousel')
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item">
                <img class="d-block img-fluid" src="{{ asset('storage/slider/1.jpg') }}" alt="First slide">
            </div>
            <div class="carousel-item active">
                <img class="d-block img-fluid" src="{{ asset('storage/slider/2.jpg') }}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="{{ asset('storage/slider/3.jpg') }}" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@endsection
@section('content')
    <div class="col-12 col-lg-6"><p class="h5 text-uppercase text-primary">Về chúng tôi</p>
        <h2 class="font-family-secondary text-uppercase mb-4">Chào mừng tới Lotus Spa</h2>
        <div class="text-muted mb-4 fs-6"><p>Gần 10 năm hoạt động là một chặng đường dài, khởi đầu từ một spa nhỏ
                trong
                khách sạn cho đến ngày nay đã trở thành spa mang sứ mệnh tiên phong đưa ngành spa tại Việt Nam theo
                kịp tiêu chuẩn của thế giới.</p>
            <p>Lotus Spa sẵn sàng làm bạn ngạc nhiên với sự chăm sóc tỉ mỉ từ những chi tiết nhỏ nhất, sự sạch sẽ
                tuyệt đối và dịch vụ bất ngờ.</p>
            <p>Điều khiến chúng tôi tự hào không chỉ là sự gia tăng về số lượng khách hàng, uy tín, doanh thu và sự
                ngày càng hoàn thiện về quy trình, chất lượng dịch vụ mà là sự gắn bó sâu sắc và nhiệt huyết của đội
                ngũ nhân viên. Chúng tôi tin rằng dịch vụ “hạnh phúc” chỉ đến từ những người hạnh phúc. Vì vậy, quan
                tâm đến mọi người là một trong những giá trị cốt lõi của Lotus Spa.</p>
        </div>
    </div>
    <div class="col-12 col-lg-6 mb-4">
        <a class="bg-cover d-block h-100 mh-2 position-relative lazyloaded"
           style="background-image: url(https://laspas.vn/ma-may/wp-content/uploads/sites/5/2022/07/Spa-Reception-1500.jpg);">
        </a>
    </div>
    <div class="row mt-5">
        <h2 class="font-family-secondary text-uppercase mb-3 text-center">Signature services</h2>
        <div class="col-12">
            <div id="carouselExampleCaption" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="https://laspas.vn/ma-may/wp-content/uploads/sites/5/2022/06/NEXT-73.jpg" alt="..."
                             class="d-block img-fluid">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="text-white">Total Foot Treatment</h3>
                            <p>Một gói chăm sóc hoàn chỉnh và điều trị tối ưu cho đôi chân.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://laspas.vn/ma-may/wp-content/uploads/sites/5/2022/06/5-2.jpg" alt="..."
                             class="d-block img-fluid">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="text-white">Himalayan Salt Stone Massage</h3>
                            <p>Liệu pháp đặc biệt này sử dụng hỗn hợp tinh dầu nguyên chất và tinh thể đá muối tự nhiên
                                được
                                hình thành cách đây 250 triệu năm ở vùng biển cổ bên dưới dãy núi Himalaya.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://laspas.vn/ma-may/wp-content/uploads/sites/5/2022/06/NEXT-83.jpg" alt="..."
                             class="d-block img-fluid">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="text-white">Ocean Package</h3>
                            <p>Các đại dương chứa đầy các nguyên tố tự nhiên và vi lượng giúp hút độc tố khỏi cơ thể
                                cũng
                                như oxy hóa tế bào, hydrat hóa, phục hồi và làm săn chắc da.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://laspas.vn/ma-may/wp-content/uploads/sites/5/2022/07/4-1500.jpg" alt="..."
                             class="d-block img-fluid">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="text-white">Sky Package</h3>
                            <p>'Bầu trời' là cách tưởng tượng mà chúng tôi muốn đề cập đến phương pháp điều trị này sẽ
                                khiến
                                bạn cảm thấy như đang ở thiên đường thứ bảy.</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaption" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaption" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <a class="btn btn-outline-primary btn-booking btn-services btn-lg mt-3 mb-3"
       href="{{ route('customers.services') }}">
        Xem tất cả dịch vụ
    </a>
@endsection
@push('js')
@endpush
