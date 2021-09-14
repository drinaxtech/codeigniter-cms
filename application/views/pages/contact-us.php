
<div class="row">

                    <!--  start contact left-->
                    <div class="col-md-12 sm-margin-50px-bottom">
                        <div>
                            <h5 class="font-size24">Contact Us</h5>
                            <div class="margin-30px-bottom">
                                <iframe class="map" id="gmap_canvas" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=<?=urlencode($contact->address);?>+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                            </div>
                            <ul class="list-style-1 margin-30px-bottom">
                                <li>
                                    <span class="d-inline-block vertical-align-top font-size18"><i class="fas fa-map-marker-alt text-theme-color"></i></span>
                                    <span class="d-inline-block width-65 sm-width-85 vertical-align-top padding-10px-left"><?=strtoupper(str_replace(";",",",$contact->address)); ?></span>
                                </li>
                                <li>
                                    <span class="d-inline-block vertical-align-top font-size18"><i class="fas fa-phone text-theme-color"></i></span>
                                    <span class="d-inline-block width-65 sm-width-85 vertical-align-top padding-10px-left"><?=$contact->phone_number; ?></span>
                                </li>
                                <li>
                                    <span class="d-inline-block vertical-align-top font-size18"><i class="fas fa-envelope text-theme-color"></i></span>
                                    <span class="d-inline-block width-65 sm-width-85 vertical-align-top padding-10px-left"><?=$contact->email; ?></span>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <!--  end contact left-->

                </div>
            </div>
        </section>
        <!-- end contact section -->