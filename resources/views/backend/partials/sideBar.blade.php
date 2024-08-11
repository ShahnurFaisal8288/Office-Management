@push('css')
<style>
    .bacground-1 {
        background: rgb(231, 231, 154);
    }

</style>
@endpush
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme bacground-1">
    <div class="app-brand demo" style="margin:5px auto 0 auto">
        <a href="/" class="app-brand-link" style="display: inline-block;margin:0 auto;">
            <span class="app-brand-logo demo">
                <img height="94px" style="object-fit:cover;" src="{{ asset('backend/img/images.png') }}" alt="">
            </span>

        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        {{-- create panel --}}
        @if(Auth::guard('admin')->user()->can('view-create-new'))
        <li class="menu-item {{ $data['active_menu']  == 'Investor' || $data['active_menu']  == 'TransactionCreate'|| $data['active_menu']  == 'Estimate'  || $data['active_menu']  == 'InvoiceCreate' || $data['active_menu']  == 'Customer' || $data['active_menu']  == 'Service'  || $data['active_menu']  == 'orderCreate' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Create New</div>
            </a>
            <ul class="menu-sub ">
                @if(Auth::guard('admin')->user()->can('view-transaction-create'))
                <li class="menu-item {{ $data['active_menu'] == 'TransactionCreate' ? 'active' : '' }}">
                    <a href="{{ route('transaction.create') }}" class="menu-link">
                        <div data-i18n="Without menu">Transaction</div>
                    </a>
                </li>
                @endif
                @if(Auth::guard('admin')->user()->can('view-estimate'))
                <li class="menu-item {{ $data['active_menu'] == 'Estimate' ? 'active' : '' }}">
                    <a href="{{ route('estimate.create') }}" class="menu-link">
                        <div data-i18n="Without menu">Estimate</div>
                    </a>
                </li>
                @endif
                @if(Auth::guard('admin')->user()->can('view-invoice'))
                <li class="menu-item {{ $data['active_menu'] == 'InvoiceCreate' ? 'active' : '' }}">
                    <a href="{{ route('invoice.create') }}" class="menu-link">
                        <div data-i18n="Without navbar">Invoice</div>
                    </a>
                </li>
                @endif
                @if(Auth::guard('admin')->user()->can('view-invoice'))
                <li class="menu-item {{ $data['active_menu'] == 'orderCreate' ? 'active' : '' }}">
                    <a href="{{ route('purchaseOrder.create') }}" class="menu-link">
                        <div data-i18n="Without navbar">Purchase Order</div>
                    </a>
                </li>
                @endif
                @if(Auth::guard('admin')->user()->can('view-customer'))
                <li class="menu-item {{ $data['active_menu'] == 'Customer' ? 'active' : '' }}">
                    <a href="{{ route('customer.create') }}" class="menu-link">
                        <div data-i18n="Without navbar">Client</div>
                    </a>
                </li>
                @endif
                @if(Auth::guard('admin')->user()->can('view-product-service'))
                <li class="menu-item {{ $data['active_menu'] == 'Service' ? 'active' : '' }}">
                    <a href="{{ route('service.create') }}" class="menu-link">
                        <div data-i18n="Without navbar">Product & Service</div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif


        {{--payment panel End --}}
        <!-- Dashboard -->
        <li class="menu-item {{ $data['active_menu'] == 'dashboard' ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        {{--  --}}
        {{-- Hr panel --}}
        @if(Auth::guard('admin')->user()->can('view-hr-management'))
        <li class="menu-item {{ $data['active_menu']  == 'Customer' || $data['active_menu']  == 'customerList'|| $data['active_menu']  == 'invoice' || $data['active_menu']  == 'allCustomer' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Client</div>
            </a>
            <ul class="menu-sub">
                @if(Auth::guard('admin')->user()->can('view-invoice-list'))
               
                    <li class="menu-item {{ $data['active_menu'] == 'invoice' ? 'active' : '' }}">
                        <a href="{{ route('invoice.index') }}" class="menu-link">
                            <div data-i18n="Without menu">Running Client list</div>
                        </a>
                    </li>
                @endif
                {{-- @if(Auth::guard('admin')->user()->can('view-customer-list'))
                <li class="menu-item {{ $data['active_menu'] == 'customerList' ? 'active' : '' }}">
                    <a href="{{ route('customer.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Running Client list</div>
                    </a>
                </li>
                @endif --}}
                <li class="menu-item {{ $data['active_menu'] == 'allCustomer' ? 'active' : '' }}">
                    <a href="{{ route('allCustomer.index') }}" class="menu-link">
                        <div data-i18n="Without menu">All Client List</div>
                    </a>
                </li>
                {{-- @if(Auth::guard('admin')->user()->can('view-customer-approval-list'))
                <li class="menu-item {{ $data['active_menu'] == 'customersApprove' ? 'active' : '' }}">
                    <a href="{{ route('customer.approve') }}" class="menu-link">
                        <div data-i18n="Without menu">Client Approval</div>
                    </a>
                </li>
                @endif --}}
               
               
            </ul>
        </li>
        @endif
        {{-- Accounts panel --}}
        @if(Auth::guard('admin')->user()->can('view-accounts'))
        <li class="menu-item {{ $data['active_menu']  == 'Accounts' || $data['active_menu']  == 'add_category' || $data['active_menu']  == 'expence' ||  $data['active_menu']  == 'InvestorPay' || $data['active_menu']  == 'InvestorList' || $data['active_menu']  == 'estimateList' || $data['active_menu']  == 'transaction' || $data['active_menu']  == 'purchaseOrderList' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Accounts</div>
            </a>
           
            @if(Auth::guard('admin')->user()->can('view-payment-form'))
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'InvestorPay' ? 'active' : '' }}">
                    <a href="{{ route('investor_pay') }}" class="menu-link">
                        <div data-i18n="Without menu">Payment Form</div>
                    </a>
                </li>
            </ul>
            @endif
            @if(Auth::guard('admin')->user()->can('view-payment-list'))
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'InvestorList' ? 'active' : '' }}">
                    <a href="{{ route('payment.list') }}" class="menu-link">
                        <div data-i18n="Without menu">Payment List</div>
                    </a>
                </li>
            </ul>
            
            @endif
           
            @if(Auth::guard('admin')->user()->can('view-expense'))
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'expence' ? 'active' : '' }}">
                    <a href="{{ route('expenselist') }}" class="menu-link">
                        <div data-i18n="Without menu">Expense</div>
                    </a>
                </li>
            </ul>
            @endif
           
            @if(Auth::guard('admin')->user()->can('view-estimate-list'))
            <ul class="menu-sub">
            <li class="menu-item {{ $data['active_menu'] == 'estimateList' ? 'active' : '' }}">
                <a href="{{ route('estimateList') }}" class="menu-link">
                    <div data-i18n="Without menu">Estimate List</div>
                </a>
            </li>
           </ul>
            @endif
            @if(Auth::guard('admin')->user()->can('view-estimate-list'))
            <ul class="menu-sub">
            <li class="menu-item {{ $data['active_menu'] == 'purchaseOrderList' ? 'active' : '' }}">
                <a href="{{ route('purchaseOrderList') }}" class="menu-link">
                    <div data-i18n="Without menu">Purchase Order List</div>
                </a>
            </li>
           </ul>
            @endif

            @if(Auth::guard('admin')->user()->can('view-transaction-list'))
            <ul class="menu-sub">
            <li class="menu-item {{ $data['active_menu'] == 'transaction' ? 'active' : '' }}">
                <a href="{{ route('transaction.index') }}" class="menu-link">
                    <div data-i18n="Without menu">Transaction</div>
                </a>
            </li>
        </ul>
            @endif
        </li>
        @endif
         {{-- Task panel --}}
         @if(Auth::guard('admin')->user()->can('view-task-management'))
         <li class="menu-item {{ $data['active_menu']  == 'task' || $data['active_menu']  == 'projectModule' || $data['active_menu']  == 'projectAssign' || $data['active_menu']  == 'project'|| $data['active_menu']  == 'task_assign'|| $data['active_menu']  == 'task_update' ? 'active open' : '' }}">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons bx bx-layout"></i>
                 <div data-i18n="Layouts">Project Management</div>
             </a>
             {{-- @if(Auth::guard('admin')->user()->can('view-task-assign')) --}}
             <ul class="menu-sub">
                 <li class="menu-item {{ $data['active_menu'] == 'project' ? 'active' : '' }}">
                      <a href="{{ route('projectCreate.index') }}" class="menu-link">
                         <div data-i18n="Without menu">Project</div>
                     </a>
                 </li>
             </ul>
             {{-- <ul class="menu-sub">
                 <li class="menu-item {{ $data['active_menu'] == 'projectModule' ? 'active' : '' }}">
                      <a href="{{ route('projectModule.index') }}" class="menu-link">
                         <div data-i18n="Without menu">Module</div>
                     </a>
                 </li>
             </ul> --}}
             <ul class="menu-sub">
                 <li class="menu-item {{ $data['active_menu'] == 'projectAssign' ? 'active' : '' }}">
                      <a href="{{ route('project.index') }}" class="menu-link">
                         <div data-i18n="Without menu">Project Assign</div>
                     </a>
                 </li>
             </ul>
             {{-- @endif --}}
             @if(Auth::guard('admin')->user()->can('view-task-assign'))
             <ul class="menu-sub">
                 <li class="menu-item {{ $data['active_menu'] == 'task_assign' ? 'active' : '' }}">
                     <a href="{{ route('task.create') }}" class="menu-link">
                         <div data-i18n="Without menu">Task Assign</div>
                     </a>
                 </li>
             </ul>
             @endif
             <ul class="menu-sub">
                 <li class="menu-item {{ $data['active_menu'] == 'task_update' ? 'active' : '' }}">
                     <a href="{{ route('taskUdate.create') }}" class="menu-link">
                         <div data-i18n="Without menu">Task Update</div>
                     </a>
                 </li>
             </ul>
         </li>
         @endif
         {{-- employee Salary panel --}}
         {{-- @if(Auth::guard('admin')->user()->can('view-task-management')) --}}
         <li class="menu-item {{ $data['active_menu']  == 'employeeSalary' ? 'active open' : '' }}">
             <a href="{{ route('employeeSalary') }}" class="menu-link ">
                 <i class="menu-icon tf-icons bx bx-layout"></i>
                 <div data-i18n="Layouts">Salary Info</div>
             </a>
         </li>
         {{-- @endif --}}





        @if(Auth::guard('admin')->user()->can('view-hr-management'))
        <li class="menu-item {{ $data['active_menu']  == 'hr' || $data['active_menu']  == 'add_employee' ||$data['active_menu']  == 'addAttendance'|| $data['active_menu']  == 'add_application' || $data['active_menu']  == 'approveList' || $data['active_menu']  == 'unblockEmployee' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">HR Management</div>
            </a>
            <ul class="menu-sub">
                @if(Auth::guard('admin')->user()->can('view-add-employee'))
                <li class="menu-item {{ $data['active_menu'] == 'add_employee' ? 'active' : '' }}">
                    <a href="{{ route('employee.create') }}" class="menu-link">
                        <div data-i18n="Without menu">Employee</div>
                    </a>
                </li>
                @endif
                @if(Auth::guard('admin')->user()->can('view-attendance-list'))
                <li class="menu-item {{ $data['active_menu'] == 'addAttendance' ? 'active' : '' }}">
                    <a href="{{ route('attendance') }}" class="menu-link">
                        <div data-i18n="Without menu">Attendance</div>
                    </a>
                </li>
                @endif
                <li class="menu-item {{ $data['active_menu'] == 'unblockEmployee' ? 'active' : '' }}">
                    <a href="{{ route('unblockEmployee') }}" class="menu-link">
                        <div data-i18n="Without menu">Unblock Employee</div>
                    </a>
                </li>
                @if(Auth::guard('admin')->user()->can('view-my-application'))
            
                    <li class="menu-item {{ $data['active_menu'] == 'add_application' ? 'active' : '' }}">
                        <a href="{{ route('application.index') }}" class="menu-link">
                            <div data-i18n="Without menu">My Application</div>
                        </a>
                    </li>
               
                @endif
                @if(Auth::guard('admin')->user()->can('view-task-assign'))
               
                    <li class="menu-item {{ $data['active_menu'] == 'create_notice' ? 'active' : '' }}">
                        <a href="{{ route('notice.index') }}" class="menu-link">
                            <div data-i18n="Without menu">Notice</div>
                        </a>
                    </li>
              
                @endif
                @if(Auth::guard('admin')->user()->can('view-leave-approve-list'))
            
                    <li class="menu-item {{ $data['active_menu'] == 'approveList' ? 'active' : '' }}">
                        <a href="{{ route('approveList') }}" class="menu-link">
                            <div data-i18n="Without menu">Approve List</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        @endif
        {{-- Domain panel --}}
        @if(Auth::guard('admin')->user()->can('view-hr-management'))
        <li class="menu-item {{ $data['active_menu']  == 'Payroll' || $data['active_menu']  == 'padDesign' || $data['active_menu']  == 'salaryAdd' || $data['active_menu']  == 'salarySheet' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Payroll</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'padDesign' ? 'active' : '' }}">
                    <a href="{{ route('pad.design') }}" class="menu-link">
                        <div data-i18n="Without menu">Pad Design</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'salaryAdd' ? 'active' : '' }}">
                    <a href="{{ route('salary') }}" class="menu-link">
                        <div data-i18n="Without menu">Salary Management</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'salarySheet' ? 'active' : '' }}">
                    <a href="{{ route('salarySheet') }}" class="menu-link">
                        <div data-i18n="Without menu">Salary Sheet</div>
                    </a>
                </li>
            </ul>
           
        </li>
        @endif
        {{-- Domain panel --}}
        @if(Auth::guard('admin')->user()->can('view-hr-management'))
        <li class="menu-item {{ $data['active_menu']  == 'domain' || $data['active_menu']  == 'add_domain' || $data['active_menu']  == 'add_hosting' || $data['active_menu']  == 'domainHosting' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Domain Hosting Management</div>
            </a>
            <ul class="menu-sub">
                @if(Auth::guard('admin')->user()->can('view-add-employee'))
                <li class="menu-item {{ $data['active_menu'] == 'add_domain' ? 'active' : '' }}">
                    <a href="{{ route('domain.create') }}" class="menu-link">
                        <div data-i18n="Without menu">Domain</div>
                    </a>
                </li>
                @endif
            </ul>
            <ul class="menu-sub">
                @if(Auth::guard('admin')->user()->can('view-add-employee'))
                <li class="menu-item {{ $data['active_menu'] == 'add_hosting' ? 'active' : '' }}">
                    <a href="{{ route('hosting.create') }}" class="menu-link">
                        <div data-i18n="Without menu">Hosting</div>
                    </a>
                </li>
                @endif
            </ul>
            <ul class="menu-sub">
                @if(Auth::guard('admin')->user()->can('view-add-employee'))
                <li class="menu-item {{ $data['active_menu'] == 'domainHosting' ? 'active' : '' }}">
                    <a href="{{ route('domainHosting.create') }}" class="menu-link">
                        <div data-i18n="Without menu">domainHosting</div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        {{-- attendance --}}
        {{-- @if(Auth::guard('admin')->user()->can('view-attendance'))
        <li class="menu-item {{ $data['active_menu']  == 'attendance' || $data['active_menu']  == 'addAttendance' || $data['active_menu']  == 'unblockEmployee' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Attendance</div>
            </a>
           
        </li>
        @endif --}}
        
       
       
       
        {{-- payment panel2 --}}
        @if(Auth::guard('admin')->user()->can('view-maintenance-payment-panel'))
        <li class="menu-item {{ $data['active_menu']  == 'Mintenance' || $data['active_menu']  == 'MaintenanceForm' || $data['active_menu']  == 'MaintenanceList' || $data['active_menu']  == 'MaintenanceDue' || $data['active_menu']  == 'MaintenancePaymentForm' || $data['active_menu']  == 'MaintenancePaymentList' | $data['active_menu']  == 'maintenancePaid' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Maintenanace Payment Panel</div>
            </a>
            <ul class="menu-sub">
                @if(Auth::guard('admin')->user()->can('view-maintenance'))
                <li class="menu-item {{ $data['active_menu'] == 'MaintenanceList' ? 'active' : '' }}">
                    <a href="{{ route('maintenance_list') }}" class="menu-link">
                        <div data-i18n="Without menu">Maintenance</div>
                    </a>
                </li>
                @endif
                @if(Auth::guard('admin')->user()->can('view-maintenance-payment-form'))
                <li class="menu-item {{ $data['active_menu'] == 'MaintenancePaymentForm' ? 'active' : '' }}">
                    <a href="{{ route('maintenancePay') }}" class="menu-link">
                        <div data-i18n="Without menu">Payment Form</div>
                    </a>
                </li>
                @endif
                @if(Auth::guard('admin')->user()->can('view-maintenance-due'))
                <li class="menu-item {{ $data['active_menu'] == 'MaintenanceDue' ? 'active' : '' }}">
                    <a href="{{ route('maintenanceDue') }}" class="menu-link">
                        <div data-i18n="Without menu">Maintenance Due</div>
                    </a>
                </li>
                @endif
                @if(Auth::guard('admin')->user()->can('view-maintenance-paid'))
                <li class="menu-item {{ $data['active_menu'] == 'maintenancePaid' ? 'active' : '' }}">
                    <a href="{{ route('maintenancePaid') }}" class="menu-link">
                        <div data-i18n="Without menu">Maintenance Paid</div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        
        
        <!-- End Notice Board -->
        @if(Auth::guard('admin')->user()->can('view-task-management'))
        <li class="menu-item {{ $data['active_menu']  == 'System Config' || $data['active_menu']  == 'add_category' || $data['active_menu']  == 'service' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">System Config</div>
            </a>
            @if(Auth::guard('admin')->user()->can('view-category'))
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'add_category' ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Expense Category</div>
                    </a>
                </li>
            </ul>
            @endif
            @if(Auth::guard('admin')->user()->can('view-product-service-list'))
            <ul class="menu-sub">
            <li class="menu-item {{ $data['active_menu'] == 'service' ? 'active' : '' }}">
                <a href="{{ route('service.index') }}" class="menu-link">
                    <div data-i18n="Without menu">Product's & Service's</div>
                </a>
            </li>
        </ul>
            @endif
        </li>
        @endif
        {{-- rol management --}}
        @if(Auth::guard('admin')->user()->can('view-role-management'))
        <li class="menu-item {{ $data['active_menu']  == 'role' || $data['active_menu']  == 'module' || $data['active_menu']  == 'subModule' || $data['active_menu']  == 'permission' || $data['active_menu']  == 'accessControl' || $data['active_menu']  == 'role' || $data['active_menu']  == 'adminList' || $data['active_menu']  == 'adminCreate' || $data['active_menu']  == 'adminEdit'? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Role Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'module' ? 'active' : '' }}">
                    <a href="{{route('module')}}" class="menu-link">
                        <div data-i18n="Basic">Module </div>
                    </a>
                </li>
                <li class="menu-item {{ $data['active_menu'] == 'subModule' ? 'active' : '' }}">
                    <a href="{{route('subModule')}}" class="menu-link">
                        <div data-i18n="Basic">Sub Module </div>
                    </a>
                </li>
                <li class="menu-item {{ $data['active_menu'] == 'permission' ? 'active' : '' }}">
                    <a href="{{route('permission')}}" class="menu-link">
                        <div data-i18n="Basic">Permission</div>
                    </a>
                </li>
                <li class="menu-item {{ $data['active_menu'] == 'accessControl' ? 'active' : '' }}">
                    <a href="{{route('access-control')}}" class="menu-link">
                        <div data-i18n="Basic">Access Control</div>
                    </a>
                </li>
                <li class="menu-item {{ $data['active_menu'] == 'role' ? 'active' : '' }}">
                    <a href="{{route('role')}}" class="menu-link">
                        <div data-i18n="Basic">Role </div>
                    </a>
                </li>
                <li class="menu-item  {{ $data['active_menu'] == 'adminList' ? 'active' : '' }}">
                    <a href="{{route('adminList')}}" class="menu-link">
                        <div data-i18n="Basic">Create Staff</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
    </ul>
</aside>
<!-- / Menu -->
