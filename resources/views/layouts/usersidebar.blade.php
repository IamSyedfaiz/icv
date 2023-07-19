  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link " href="{{ route('home') }}">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#compliance" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-patch-check"></i><span>Consultant</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="compliance" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('add.consultant') }}">
                          <i class="bi bi-circle"></i><span>Add New</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('all.consultant') }}">
                          <i class="bi bi-circle"></i><span>Manage All</span>
                      </a>
                  </li>

              </ul>
          </li><!-- End Dashboard Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#business" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-building"></i><span>Certificate</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="business" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  {{-- <li>
                      <a href="{{ route('view.draft.cert') }}">
                          <i class="bi bi-circle"></i><span>New</span>
                      </a>
                  </li> --}}
                  <li>
                      <a href="{{ route('all.certs') }}">
                          <i class="bi bi-circle"></i><span>View All</span>
                      </a>
                  </li>

              </ul>
          </li>



          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#events" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-calendar4-event"></i><span>Payment</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="events" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('consultant.payment') }}">
                          <i class="bi bi-circle"></i><span>View All</span>
                      </a>
                  </li>
              </ul>
          </li><!-- End Components Nav -->


          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#form" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-calendar4-event"></i><span>Form</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="form" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('create.invoice') }}">
                          <i class="bi bi-circle"></i><span>Invoice</span>
                      </a>
                  </li>
              </ul>
          </li><!-- End Components Nav -->

      </ul>

  </aside><!-- End Sidebar-->
