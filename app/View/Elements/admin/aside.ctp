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
                          <span>Eventos</span>
                      </a>
                      <ul class="sub">
                          <li><?= $this->Html->link(__('Listar'),array(
                                        'controller'=>'events','action'=>'index'),array(
                                        'escape' => false,
                                        ));?>
                          </li>
                           <li><?= $this->Html->link(__('Adicionar'),array(
                                        'controller'=>'events','action'=>'add'),array(
                                        'escape' => false,
                                        ));?>
                          </li>
                      </ul>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->