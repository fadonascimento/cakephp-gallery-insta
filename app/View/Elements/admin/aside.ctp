      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-dashboard"></i>
                          <span><?= __('Clientes'); ?></span>
                      </a>
                      <ul class="sub">
                          <li><?= $this->Html->link(__('Listar'),array(
                                        'controller'=>'users','action'=>'listCustomer'),array(
                                        'escape' => false,
                                        ));?>
                          </li>
                          <li><?= $this->Html->link(__('Cadastrar'),array(
                                        'controller'=>'users','action'=>'addCustomer'),array(
                                        'escape' => false,
                                        ));?>
                          </li>
                      </ul>
                    
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-laptop"></i>
                          <span>Layouts</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="boxed_page.html">Boxed Page</a></li>
                          <li><a  href="horizontal_menu.html">Horizontal Menu</a></li>
                          <li><a  href="language_switch_bar.html">Language Switch Bar</a></li>
                      </ul>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->