      <div class="row justify-content-center">
        <div class="col-md-8">
          <form action="" method="post">
            <div class="card-group">
              <div class="card p-4">
                <div class="card-body">
                  <h1>Acceso Restringido</h1>
                  <p class="text-muted">Ingrese al Panel con una Cuenta Administradora</p>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend"><span class="input-group-text">
                        <svg class="c-icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                        </svg></span></div>
                    <input name="data[Login][user]" class="form-control" type="text" placeholder="Usuario">
                  </div>
                  <div class="input-group mb-4">
                    <div class="input-group-prepend"><span class="input-group-text">
                        <svg class="c-icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                        </svg></span></div>
                    <input name="data[Login][password]" class="form-control" type="password" placeholder="Contraseña">
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <button class="btn btn-primary px-4" type="submit">Acceder</button>
                    </div>
                    <div class="col-6 text-right">
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="card text-white py-5 d-md-down-none" style="width:44%">
                <div class="card-body text-center justify-content-center">
                  <div>
                    <?php echo $this->Html->image('logo.svg',array('class'=>'img-fluid')); ?>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>