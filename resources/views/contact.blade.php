@extends('blog.layouts')

@section('title','博文分类')

@section('content')
    <!-- begin col-9 -->
	<div class="col-lg-9">
        <!-- begin section-container -->
        <div class="section-container">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3306.9584799260138!2d-118.49437019999998!3d34.019276700000006!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2a4cedd1266ff%3A0x1ffe328381544853!2sGoogle+Inc!5e0!3m2!1sen!2s!4v1435718319426" allowfullscreen></iframe>
            </div>
        </div>
        <!-- end section-container -->
        <!-- begin section-container -->
        <div class="section-container">
            <h4 class="section-title m-b-20"><span>CONTACT US</span></h4>
            <p class="m-b-30">
                If you have a project you would like to discuss, get in touch with us.
                Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, 
                lectus arcu pulvinar risus, vitae facilisis libero dolor a purus.
            </p>
            <!-- begin row -->
            <div class="row row-space-30">
                <!-- begin col-8 -->
                <div class="col-md-8">
                    <form class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 text-md-right">Name <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 text-md-right">Email <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 text-md-right">Message <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 text-md-right"></label>
                            <div class="col-md-9 text-left">
                                <button type="submit" class="btn btn-inverse btn-lg btn-block">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end col-8 -->
                <!-- begin col-4 -->
                <div class="col-md-4">
                    <p>
                        <strong>SeanTheme Studio, Inc</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        P: (123) 456-7890<br>
                    </p>
                    <p>
                        <span class="phone">+11 (0) 123 456 78</span><br>
                        <a href="mailto:hello@emailaddress.com">seanthemes@support.com</a>
                    </p>
                </div>
                <!-- end col-4 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end section-container -->
    </div>
	<!-- end col-9 -->
@endsection