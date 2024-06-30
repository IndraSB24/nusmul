<?php

namespace App\Controllers;

class Home extends BaseController
{
	
	public function index()
	{
		
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Minia', 'li_2' => 'Dashboard'])
		];
		
		return view('index', $data);
	}

	public function show_index_dark()
	{
		
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Minia', 'li_2' => 'Dashboard'])
		];
		
		return view('index-dark', $data);
	}

	public function show_index_rtl()
	{
		
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Minia', 'li_2' => 'Dashboard'])
		];
		
		return view('index-rtl', $data);
	}

	public function show_colored_sidebar()
	{
		
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Minia', 'li_2' => 'Dashboard'])
		];
		
		return view('layouts-colored-sidebar', $data);
	}

	public function show_layouts_boxed()
	{
		
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Minia', 'li_2' => 'Dashboard'])
		];
		
		return view('layouts-boxed', $data);
	}

	public function show_compact_sidebar()
	{
		
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Minia', 'li_2' => 'Dashboard'])
		];
		
		return view('layouts-compact-sidebar', $data);
	}

	public function show_dark_sidebar()
	{
		
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Minia', 'li_2' => 'Dashboard'])
		];
		
		return view('layouts-dark-sidebar', $data);
	}

	public function show_icon_sidebar()
	{
		
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Minia', 'li_2' => 'Dashboard'])
		];
		
		return view('layouts-icon-sidebar', $data);
	}

	public function show_layouts_scrollable()
	{
		
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Minia', 'li_2' => 'Dashboard'])
		];
		
		return view('layouts-scrollable', $data);
	}

	public function show_calendar(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Calendar']),
			'page_title' => view('partials/page-title', ['title' => 'Calendar', 'li_1' => 'Apps', 'li_2' => 'Calendar'])
		];
		return view('apps-calendar', $data);
	}

	public function show_chat(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Chat']),
			'page_title' => view('partials/page-title', ['title' => 'Chat', 'li_1' => 'Apps', 'li_2' => 'Chat'])
		];
		return view('apps-chat', $data);
	}

	public function show_email_inbox(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Inbox']),
			'page_title' => view('partials/page-title', ['title' => 'Inbox', 'li_1' => 'Email', 'li_2' => 'Inbox'])
		];
		return view('apps-email-inbox', $data);
	}

	public function show_email_read(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Read_Email']),
			'page_title' => view('partials/page-title', ['title' => 'Read_Email', 'li_1' => 'Email', 'li_2' => 'Email Read'])
		];
		return view('apps-email-read', $data);
	}
	
	public function show_invoices_list(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Invoice_List']),
			'page_title' => view('partials/page-title', ['title' => 'Invoice_List', 'li_1' => 'Invoices', 'li_2' => 'Invoice List'])
		];
		return view('apps-invoices-list', $data);
	}

	public function show_invoices_detail(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Invoice_Detail']),
			'page_title' => view('partials/page-title', ['title' => 'Invoice_Detail', 'li_1' => 'Invoices', 'li_2' => 'Invoice Detail'])
		];
		return view('apps-invoices-detail', $data);
	}
	public function show_contacts_grid(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'User_Grid']),
			'page_title' => view('partials/page-title', ['title' => 'User_Grid', 'li_1' => 'Contacts' , 'li_2' => 'User Grid'])
		];
		return view('apps-contacts-grid', $data);
	}

	public function show_contacts_list(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'User_List']),
			'page_title' => view('partials/page-title', ['title' => 'User_List', 'li_1' => 'Contacts' , 'li_2' => 'User List'])
		];
		return view('apps-contacts-list', $data);
	}

	public function show_contacts_profile(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Profile']),
			'page_title' => view('partials/page-title', ['title' => 'Profile', 'li_1' => 'Contacts' , 'li_2' => 'Profile'])
		];
		return view('apps-contacts-profile', $data);
	}

	// // Horizontal Layout Pages Routes
	public function show_layouts_horizontal()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Horizontal']),
			'page_title' => view('partials/page-title', ['title' => 'Horizontal', 'li_1' => 'Layouts', 'li_2' => 'Horizontal'])
		];
		return view('layouts-horizontal', $data);
	}

	public function show_layouts_horizontal_boxed()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Horizontal']),
			'page_title' => view('partials/page-title', ['title' => 'Horizontal', 'li_1' => 'Layouts', 'li_2' => 'Horizontal'])
		];
		return view('layouts-horizontal-boxed', $data);
	}

	public function show_layouts_horizontal_dark()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Horizontal']),
			'page_title' => view('partials/page-title', ['title' => 'Horizontal', 'li_1' => 'Layouts', 'li_2' => 'Horizontal'])
		];
		return view('layouts-horizontal-dark', $data);
	}

	public function show_layouts_horizontal_rtl()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Horizontal']),
			'page_title' => view('partials/page-title', ['title' => 'Horizontal', 'li_1' => 'Layouts', 'li_2' => 'Horizontal'])
		];
		return view('layouts-horizontal-rtl', $data);
	}

	public function show_layouts_horizontal_scrollable()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Horizontal']),
			'page_title' => view('partials/page-title', ['title' => 'Horizontal', 'li_1' => 'Layouts', 'li_2' => 'Horizontal'])
		];
		return view('layouts-horizontal-scrollable', $data);
	}

	public function show_layouts_dark_topbar()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Horizontal']),
			'page_title' => view('partials/page-title', ['title' => 'Horizontal', 'li_1' => 'Layouts', 'li_2' => 'Horizontal'])
		];
		return view('layouts-horizontal-dark-topbar', $data);
	}

	// Pages
	public function show_auth_login()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Login'])
		];
		return view('auth-login', $data);
	}
	public function show_auth_register()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Register'])
		];
		return view('auth-register', $data);
	}
	public function show_auth_recoverpw()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Recover_Password'])
		];
		return view('auth-recoverpw', $data);
	}
	public function show_auth_lock_screen()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Lock_Screen'])
		];
		return view('auth-lock-screen', $data);
	}
	public function show_auth_confirm_mail()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Confirm_Mail'])
		];
		return view('auth-confirm-mail', $data);
	}
	public function show_auth_email_verification()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Email_Verification'])
		];
		return view('auth-email-verification', $data);
	}
	public function show_auth_two_step_verification()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Two_Step_Verification'])
		];
		return view('auth-two-step-verification', $data);
	}

	public function show_pages_starter()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Starter_Page']),
			'page_title' => view('partials/page-title', ['title' => 'Starter_Page', 'li_1' => 'Pages', 'li_2' => 'Starter Page'])
		];
		return view('pages-starter', $data);
	}
	public function show_pages_invoice()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Invoice']),
			'page_title' => view('partials/page-title', ['title' => 'Invoice', 'li_1' => 'Pages', 'li_2' => 'Invoice'])
		];
		return view('pages-invoice', $data);
	}
	public function show_pages_profile()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Profile']),
			'page_title' => view('partials/page-title', ['title' => 'Profile', 'li_1' => 'Pages', 'li_2' => 'Profile'])
		];
		return view('pages-profile', $data);
	}
	public function show_pages_maintenance()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Maintenance'])
		];
		return view('pages-maintenance', $data);
	}
	public function show_pages_comingsoon()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Coming_Soon'])
		];
		return view('pages-comingsoon', $data);
	}
	public function show_pages_timeline()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Timeline']),
			'page_title' => view('partials/page-title', ['title' => 'Timeline', 'li_1' => 'Pages', 'li_2' => 'Timeline'])
		];
		return view('pages-timeline', $data);
	}
	public function show_pages_faqs()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'FAQs']),
			'page_title' => view('partials/page-title', ['title' => 'FAQs', 'li_1' => 'Pages', 'li_2' => 'FAQs'])
		];
		return view('pages-faqs', $data);
	}
	public function show_pages_pricing()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Pricing']),
			'page_title' => view('partials/page-title', ['title' => 'Pricing', 'li_1' => 'Pages', 'li_2' => 'Pricing'])
		];
		return view('pages-pricing', $data);
	}
	public function show_pages_404()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Error_404'])
		];
		return view('pages-404', $data);
	}
	public function show_pages_500()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Error_500'])
		];
		return view('pages-500', $data);
	}
	public function show_ui_offcanvas()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Offcanvas']),
			'page_title' => view('partials/page-title', ['title' => 'Offcanvas', 'li_1' => 'Components', 'li_2' => 'Offcanvas'])
		];
		return view('ui-offcanvas', $data);
	}

	// UI Elements
	public function show_ui_alerts()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Alerts']),
			'page_title' => view('partials/page-title', ['title' => 'Alerts', 'li_1' => 'Components', 'li_2' => 'Alerts'])
		];
		return view('ui-alerts', $data);
	}
	public function show_ui_buttons()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Buttons']),
			'page_title' => view('partials/page-title', ['title' => 'Buttons', 'li_1' => 'Components', 'li_2' => 'Buttons'])
		];
		return view('ui-buttons', $data);
	}
	public function show_ui_cards()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Cards']),
			'page_title' => view('partials/page-title', ['title' => 'Cards', 'li_1' => 'Components', 'li_2' => 'Cards'])
		];
		return view('ui-cards', $data);
	}
	public function show_ui_carousel()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Carousel']),
			'page_title' => view('partials/page-title', ['title' => 'Carousel', 'li_1' => 'Components', 'li_2' => 'Carousel'])
		];
		return view('ui-carousel', $data);
	}
	public function show_ui_dropdowns()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dropdowns']),
			'page_title' => view('partials/page-title', ['title' => 'Dropdowns', 'li_1' => 'Components', 'li_2' => 'Dropdowns'])
		];
		return view('ui-dropdowns', $data);
	}
	public function show_ui_grid()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Grid']),
			'page_title' => view('partials/page-title', ['title' => 'Grid', 'li_1' => 'Components', 'li_2' => 'Grid'])
		];
		return view('ui-grid', $data);
	}
	public function show_ui_images()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Images']),
			'page_title' => view('partials/page-title', ['title' => 'Images', 'li_1' => 'Components', 'li_2' => 'Images'])
		];
		return view('ui-images', $data);
	}
	public function show_ui_modals()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Modals']),
			'page_title' => view('partials/page-title', ['title' => 'Modals', 'li_1' => 'Components', 'li_2' => 'Modals'])
		];
		return view('ui-modals', $data);
	}
	
	public function show_ui_progressbars()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Progress_Bars']),
			'page_title' => view('partials/page-title', ['title' => 'Progress_Bars', 'li_1' => 'Components', 'li_2' => 'Progress Bars'])
		];
		return view('ui-progressbars', $data);
	}
	
	public function show_ui_tabs_accordions()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Tabs_n_Accordions']),
			'page_title' => view('partials/page-title', ['title' => 'Tabs_n_Accordions', 'li_1' => 'Components', 'li_2' => 'Tabs & Accordions'])
		];
		return view('ui-tabs-accordions', $data);
	}
	public function show_ui_typography()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Typography']),
			'page_title' => view('partials/page-title', ['title' => 'Typography', 'li_1' => 'Components', 'li_2' => 'Typography'])
		];
		return view('ui-typography', $data);
	}
	public function show_ui_video()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Video']),
			'page_title' => view('partials/page-title', ['title' => 'Video', 'li_1' => 'Components', 'li_2' => 'Video'])
		];
		return view('ui-video', $data);
	}
	public function show_ui_general()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'General']),
			'page_title' => view('partials/page-title', ['title' => 'General', 'li_1' => 'Components', 'li_2' => 'General'])
		];
		return view('ui-general', $data);
	}
	public function show_ui_colors()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Colors']),
			'page_title' => view('partials/page-title', ['title' => 'Colors', 'li_1' => 'Components', 'li_2' => 'Colors'])
		];
		return view('ui-colors', $data);
	}

	//Extended
	public function show_extended_lightbox()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Lightbox']),
			'page_title' => view('partials/page-title', ['title' => 'Lightbox', 'li_1' => 'Extended', 'li_2' => 'Lightbox'])
		];
		return view('extended-lightbox', $data);
	}

	public function show_extended_rangeslider()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Range_Slider']),
			'page_title' => view('partials/page-title', ['title' => 'Range_Slider', 'li_1' => 'Extended', 'li_2' => 'Range Slider'])
		];
		return view('extended-rangeslider', $data);
	}
	public function show_extended_session_timeout()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Session_Timeout']),
			'page_title' => view('partials/page-title', ['title' => 'Session_Timeout', 'li_1' => 'Extended', 'li_2' => 'Session Timeout'])
		];
		return view('extended-session-timeout', $data);
	}
	public function show_extended_sweet_alert()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'SweetAlert_2']),
			'page_title' => view('partials/page-title', ['title' => 'SweetAlert_2', 'li_1' => 'Extended', 'li_2' => 'SweetAlert 2'])
		];
		return view('extended-sweet-alert', $data);
	}
	public function show_extended_rating()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Rating']),
			'page_title' => view('partials/page-title', ['title' => 'Rating', 'li_1' => 'Extended', 'li_2' => 'Rating'])
		];
		return view('extended-rating', $data);
	}
	public function show_extended_notification()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Notifications']),
			'page_title' => view('partials/page-title', ['title' => 'Notifications', 'li_1' => 'Extended', 'li_2' => 'Notifications'])
		];
		return view('extended-notifications', $data);
	}

	// Forms
	public function show_form_elements()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Basic_Elements']),
			'page_title' => view('partials/page-title', ['title' => 'Basic_Elements', 'li_1' => 'Forms', 'li_2' => 'Basic Elements'])
		];
		return view('form-elements', $data);
	}
	public function show_form_validation()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Validation']),
			'page_title' => view('partials/page-title', ['title' => 'Validation', 'li_1' => 'Forms', 'li_2' => 'Validation'])
		];
		return view('form-validation', $data);
	}
	public function show_form_advanced()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Advanced_Plugins']),
			'page_title' => view('partials/page-title', ['title' => 'Advanced_Plugins', 'li_1' => 'Forms', 'li_2' => 'Advanced Plugins'])
		];
		return view('form-advanced', $data);
	}
	public function show_form_editors()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Editors']),
			'page_title' => view('partials/page-title', ['title' => 'Editors', 'li_1' => 'Forms', 'li_2' => 'Editors'])
		];
		return view('form-editors', $data);
	}
	public function show_form_uploads()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'File_Upload']),
			'page_title' => view('partials/page-title', ['title' => 'File_Upload', 'li_1' => 'Forms', 'li_2' => 'File Upload'])
		];
		return view('form-uploads', $data);
	}
	
	public function show_form_wizard()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Wizard']),
			'page_title' => view('partials/page-title', ['title' => 'Wizard', 'li_1' => 'Forms', 'li_2' => 'Wizard'])
		];
		return view('form-wizard', $data);
	}
	public function show_form_mask()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Mask']),
			'page_title' => view('partials/page-title', ['title' => 'Mask', 'li_1' => 'Forms', 'li_2' => 'Mask'])
		];
		return view('form-mask', $data);
	}

	// Tables
	public function show_tables_basic()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Bootstrap_Basic']),
			'page_title' => view('partials/page-title', ['title' => 'Bootstrap_Basic', 'li_1' => 'Tables', 'li_2' => 'Bootstrap Basic'])
		];
		return view('tables-basic', $data);
	}
	public function show_tables_datatable()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'DataTables']),
			'page_title' => view('partials/page-title', ['title' => 'DataTables', 'li_1' => 'Tables', 'li_2' => 'DataTables'])
		];
		return view('tables-datatable', $data);
	}
	public function show_tables_responsive()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Responsive']),
			'page_title' => view('partials/page-title', ['title' => 'Responsive', 'li_1' => 'Tables', 'li_2' => 'Responsive'])
		];
		return view('tables-responsive', $data);
	}
	public function show_tables_editable()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Editable']),
			'page_title' => view('partials/page-title', ['title' => 'Editable', 'li_1' => 'Tables', 'li_2' => 'Editable'])
		];
		return view('tables-editable', $data);
	}

	// Charts
	public function show_charts_apex()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Apexcharts']),
			'page_title' => view('partials/page-title', ['title' => 'Apexcharts', 'li_1' => 'Charts', 'li_2' => 'Apexcharts'])
		];
		return view('charts-apex', $data);
	}
	public function show_charts_chartjs()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Chartjs']),
			'page_title' => view('partials/page-title', ['title' => 'Chartjs', 'li_1' => 'Charts', 'li_2' => 'Chartjs'])
		];
		return view('charts-chartjs', $data);
	}
	public function show_charts_echart()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Echarts']),
			'page_title' => view('partials/page-title', ['title' => 'Echarts', 'li_1' => 'Charts', 'li_2' => 'Echarts'])
		];
		return view('charts-echart', $data);
	}
	public function show_charts_knob()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Jquery_Knob']),
			'page_title' => view('partials/page-title', ['title' => 'Jquery_Knob', 'li_1' => 'Charts', 'li_2' => 'Jquery Knob'])
		];
		return view('charts-knob', $data);
	}
	public function show_charts_sparkline()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Sparkline']),
			'page_title' => view('partials/page-title', ['title' => 'Sparkline', 'li_1' => 'Charts', 'li_2' => 'Sparkline'])
		];
		return view('charts-sparkline', $data);
	}

	// Icons
	public function show_icons_boxicons()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Boxicons']),
			'page_title' => view('partials/page-title', ['title' => 'Boxicons', 'li_1' => 'Icons', 'li_2' => 'Boxicons'])
		];
		return view('icons-boxicons', $data);
	}
	public function show_icons_materialdesign()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Material_Design']),
			'page_title' => view('partials/page-title', ['title' => 'Material_Design', 'li_1' => 'Icons', 'li_2' => 'Material Design'])
		];
		return view('icons-materialdesign', $data);
	}
	public function show_icons_dripicons()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dripicons']),
			'page_title' => view('partials/page-title', ['title' => 'Dripicons', 'li_1' => 'Icons', 'li_2' => 'Dripicons'])
		];
		return view('icons-dripicons', $data);
	}
	public function show_icons_fontawesome()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Font_Awesome_5']),
			'page_title' => view('partials/page-title', ['title' => 'Font_Awesome_5', 'li_1' => 'Icons', 'li_2' => 'Font Awesome 5'])
		];
		return view('icons-fontawesome', $data);
	}

	// Maps
	public function show_maps_google()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Google']),
			'page_title' => view('partials/page-title', ['title' => 'Google', 'li_1' => 'Maps', 'li_2' => 'Google'])
		];
		return view('maps-google', $data);
	}
	public function show_maps_vector()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Vector']),
			'page_title' => view('partials/page-title', ['title' => 'Vector', 'li_1' => 'Maps', 'li_2' => 'Vector'])
		];
		return view('maps-vector', $data);
	}
	public function show_maps_leaflet()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Leaflet']),
			'page_title' => view('partials/page-title', ['title' => 'Leaflet', 'li_1' => 'Maps', 'li_2' => 'Leaflet'])
		];
		return view('maps-vector', $data);
	}

}
