<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{URL::to('dashboard')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link"  href="{{URL::to('fund-collection')}}" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Product Sale</span>
            </a>
          </li> -->

          <!-- <li class="nav-item">
            <a class="nav-link"  href="{{URL::to('profile-update')}}" aria-expanded="false" aria-controls="charts">
            <i class="mdi mdi-source-branch menu-icon"></i>
              <span class="menu-title">Profile Update</span>
            </a>
          </li> -->

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#masters" aria-expanded="false" aria-controls="charts">
            <i class="mdi mdi-group menu-icon"></i> 
              <span class="menu-title">Masters </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="masters">
              <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('income-master')}}">Income Master</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('expense-master')}}">Expense Master</a></li>
              </ul>
            </div>
            
     
          </li>

                    <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#transaction" aria-expanded="false" aria-controls="charts">
            <i class="mdi mdi-group menu-icon"></i> 
              <span class="menu-title">Transaction</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="transaction">
              <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('receipt-voucher')}}"> Receipt Voucher</a></li>
              
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('payment-voucher')}}">Payment Voucher</a></li>
             

              </ul>
            </div>
            
     
          </li>
          
     



          

                 
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#collection_report" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Report</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="collection_report">
              <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('receipt-voucher-report')}}">Receipt Voucher</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('payment-voucher-report')}}">Payment Voucher</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('monthly-share-report')}}">Monthly Report</a></li>
              </ul>
            </div>
     
          </li>
           

         
        </ul>
      </nav>