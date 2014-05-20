      <?= $this->Form->create('User',array('class'=>'form-signin'));?>
      <form class="form-signin" action="index.html">
        <h2 class="form-signin-heading"><?= __('Entrar agora'); ?></h2>
        <div class="login-wrap">
            <?= $this->Form->input('email',array(
                                                'label'=> false,
                                                'class'=>'form-control',
                                                'placeholder' => __('Email'),
                                                'div'=>false));?>
            <?= $this->Form->input('password',array(
                                                'label'=> false,
                                                'placeholder' => __('Senha'),
                                                'class'=>'form-control',
                                                'div'=>false));?>
           
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> <?= __('Lembre-me'); ?>
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"><?= __('Esqueceu a senha?'); ?></a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit"><?= __('Entre') ?></button>
           <!--  <p><?= __('ou você pode se inscrever via rede social');?></p>
            <div class="login-social-link">
                <a href="index.html" class="facebook">
                    <i class="icon-facebook"></i>
                    Facebook
                </a>
                <a href="index.html" class="twitter">
                    <i class="icon-twitter"></i>
                    Twitter
                </a>
            </div>
            <div class="registration">
                <?= __('Não tem uma conta ainda?'); ?>
                <a class="" href="registration.html">
                  <?= __('Criar uma conta'); ?>
                </a>
            </div>
 -->
        </div>

      <?= $this->Form->end(false);?>
      
         
      <?= $this->Form->create('Users',array('class'=>'form-signin'));?>
          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title"><?= __('Esqueceu a senha?'); ?></h4>
                      </div>
                      <div class="modal-body">
                          <p><?= __('Digite abaixo seu endereço de e-mail para redefinir sua senha.'); ?></p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button"><?= __('Sair'); ?></button>
                          <button class="btn btn-success" type="button"><?= __('Enviar'); ?></button>
                      </div>
                  </div>
              </div>
          </div>
      <?= $this->Form->end(false);?>