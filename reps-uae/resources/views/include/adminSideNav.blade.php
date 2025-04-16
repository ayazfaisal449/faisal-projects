
<style>

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }
    .dropdown-content a:hover {
        background-color: #ddd;
    }
    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>
<nav>
    <ul>
        <li class="lnk-trainer">
            <a class="clearfix" href="{{ Request::root()}}/admin/trainer">
                <img src="{{Request::root()}}/img/lnkTrainerIco.png" alt="Icon" />
                <span>Trainers</span>
            </a>
        </li>

        <li>
            <a class="clearfix" href="{{ Request::root()}}/admin/courseProvider">
                <img src="{{Request::root()}}/img/icon.png" alt="Icon" />
                <span>Course Providers</span>

            </a>
        </li>

        <li>
            <a class="clearfix" href="{{ Request::root()}}/admin/course">
                <img src="{{Request::root()}}/img/icon.png" alt="Icon" />
                <span>Courses</span>

            </a>
        </li>

        <li>
            <a class="clearfix" href="{{ Request::root()}}/admin/slider">
                <img src="{{Request::root()}}/img/icon.png" alt="Icon" />
                <span>Slider Photos</span>

            </a>
        </li>

        <li>
            <a class="clearfix" href="{{ Request::root()}}/admin/facility-slider">
                <img src="{{Request::root()}}/img/icon.png" alt="Icon" />
                <span>Registered Facilities</span>

            </a>
        </li>

        <li>
            <a class="clearfix" href="{{ Request::root()}}/admin/partner">
                <img src="{{Request::root()}}/img/icon.png" alt="Icon" />
                <span>Partners Page</span>

            </a>
        </li>

        <li>
            <a class="clearfix" href="{{ Request::root()}}/admin/benefit">
                <img src="{{Request::root()}}/img/icon.png" alt="Icon" />
                <span>Benefits Page</span>

            </a>
        </li>
		<li>
            <a class="clearfix" href="{{ Request::root()}}/admin/jobs">
                <img src="{{Request::root()}}/img/icon.png" alt="Icon" />
                <span>Jobs Page</span>
            </a>
        </li>
        <li>
            <a class="clearfix" href="{{ Request::root()}}/admin/faq">
                <img src="{{Request::root()}}/img/icon.png" alt="Icon" />
                <span>FAQ Page</span>

            </a>
        </li>
        <li>
            <a class="clearfix" href="{{ Request::root()}}/admin/app-courses">
                <img src="{{Request::root()}}/img/icon.png" alt="Icon" />
                <span>App Courses</span>

            </a>
        </li>

        <li>
            <a class="clearfix" href="{{ Request::root()}}/admin/approval">
                <img src="{{Request::root()}}/img/icon.png" alt="icon" />
                <span>New Member Approval</span>
            </a>
        </li>

        <li>
            <a class="clearfix" href="{{ Request::root()}}/admin/footer">
                <img src="{{Request::root()}}/img/icon.png" alt="icon" />
                <span>Footer Pages</span>
            </a>
        </li>

        <li>
            <a class="clearfix" href="{{ Request::root()}}/admin/team">
                <img src="{{Request::root()}}/img/icon.png" alt="icon" />
                <span>Team</span>
            </a>
        </li>
        
        <li>
            <a class="clearfix" href="{{ Request::root()}}/admin/blog-category">
                <img src="{{Request::root()}}/img/icon.png" alt="icon" />
                <span>Blog Category</span>
            </a>
        </li>
        <li>
            <a class="clearfix" href="{{ Request::root()}}/admin/blog">
                <img src="{{Request::root()}}/img/icon.png" alt="icon" />
                <span>Blog</span>
            </a>
        </li>


        <!-- <div class="dropdown">
          <img src="{{Request::root()}}/img/icon.png" alt="icon" style="position: relative;left: 10px;" />  <span style="color: white; position: relative;left: 10px;"> Footer</span> 
            
            <div class="dropdown-content">
              <a class="clearfix" href="{{ Request::root()}}/admin/footer">About REps</a>
              <a href="{{ Request::root()}}/admin/meet_team">Meet the team</a>
              <a href="#">Global Partners</a>
            </div>
          </div>  -->
        <li>
            <a class="clearfix" href="{{ Request::root()}}/admin/setting/update/1">
                <img src="{{Request::root()}}/img/icon.png" alt="icon" />
                <span>Setting</span>
            </a>
        </li>


        <!-- <li>
        <a class="clearfix" href="{{ Request::root()}}/admin/footer">
        <img src="{{Request::root()}}/img/icon.png" alt="icon" />
        <span>Footer</span>
        </a>
        </li> -->


        
        <li>
            <a class="drop clearfix" href="">
                <img src="{{Request::root()}}/img/lnkMediaIco.png" alt="Icon" />
                <span>Media</span>
                <img class="dropDown" src="{{Request::root()}}/img/dropdown.fw.png" alt="Icon" />
            </a>
            <ol>
                <li><a href="{{ Request::root()}}/admin/video">Video</a></li>
                <li><a href="{{ Request::root()}}/admin/gallery">Photo Gallery</a></li>
            </ol>
        </li>

    </ul>
</nav>
