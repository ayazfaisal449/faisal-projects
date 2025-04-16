<div class="row updateStatusRequest">
    <div class="large-6 columns">
        @if(isset($upgrade_status) && $upgrade_status->is_processed == 0)
        <a class="statusUpgradeBtn clearfix" href="{{ Request::root()}}/admin/trainer/upgrade-status/{{$upgrade_status->id}}">
            <img src="{{Request::root()}}/img/admin/status_upgrade_icon.png" alt="Icon" />
            <span>Status Upgrade Request</span>
        </a>

        <br>
        @endif
        
        @if(isset($upgrade_category_status) && $upgrade_category_status->is_processed == 0)
        <a class="levelRegUpgradeBtn clearfix" href="{{ Request::root()}}/admin/trainer/upgrade-level-category/{{$upgrade_category_status->id}}">
            <img src="{{Request::root()}}/img/admin/level_reg_icon.png" alt="Icon" />
            <span>Level of Registration Upgrade Request</span>
        </a>
        @endif
        
    </div>

	@if(isset($upgrade_status) || isset($upgrade_category_status))
    <div class="large-6 columns">
        <div class="noticesDiv">
            <h3><span class="noticeIcon"></span>Notices</h3>
             @if(isset($upgrade_status) && $upgrade_status->is_processed == 0)
            <p>Status Upgrade Request <span class="right">{{ date("d/m/y",strtotime($upgrade_status->created_at)) }}</span></p>
            @endif
            
            @if(isset($upgrade_category_status) && $upgrade_category_status->is_processed == 0)
            <p>Level of Registration Upgrade Request <span class="right">{{ date("d/m/y",strtotime($upgrade_category_status->created_at)) }}</span></p>
            @endif
        </div>
    </div>
	@endif
</div>

