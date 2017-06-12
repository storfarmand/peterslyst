        <div class="nav-wrapper container-fluid">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <a href="https://www.facebook.com/gaardbutikken.peterslyst" class="facebook" target="_blank"><i class="fa fa-facebook-official fa-3x"></i></a>
                <button class="navbar-toggle" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <nav class="primary">
                    <ul class="">
                        <li<?php if(strlen($pageRequested) > 0 && gettype(strpos("udvalg historie om", $pageRequested)) == "integer") echo " class=\"active\""; ?>><a href="om">gårdbutikken</a>
                            <ul class="sub">
                                <li><a href="udvalg">Udvalg</a></li>
                                <li><a href="historie">Historie</a></li>
                                <li><a href="om">Om Peterslyst</a></li>
                            </ul>
                        </li>
                        <li<?php if(strlen($pageRequested) > 0 && gettype(strpos("udlejning campingvogn", $pageRequested)) == "integer") echo " class=\"active\""; ?>><a href="udlejning">Udlejning</a>
                            <ul class="sub">
                                <li><a href="udlejning">Værktøj og udstyr</a></li>
                                <li><a href="campingvogn">Campingvogne</a></li>
                            </ul>
			</li>
                        <li<?php if($pageRequested == "vikarservice") echo " class=\"active\""; ?>><a href="vikarservice">Palles vikarservice</a></li>
                        <li<?php if($pageRequested == "kontakt") echo " class=\"active\""; ?>><a href="kontakt">Kontakt</a></li>
                    </ul>
                </nav>
                <div class="logo hidden-xs"><a href="/">Home</a></div>
                <div class="mobile-logo hidden-lg hidden-md hidden-sm"><a href="/">Home</a></div>
            </div>
        </div>
