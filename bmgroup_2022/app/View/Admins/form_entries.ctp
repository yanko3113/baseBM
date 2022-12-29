<div class="container-fluid">
  <div class="fade-in">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-4">
                <?=$this->Html->link('Exportar a Excel', array('controller'=>'admins','action'=>'form_entries','?'=>array('excel'=>1)), array('class'=>'btn btn-primary'))?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <table class="table table-responsive-sm mt-3">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Servicio</th>
                  <th>País</th>
                  <th>Nombre Completo</th>
                  <th>Email</th>
                  <th>Teléfono</th>
                  <th>Notas</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($form_entries as $item): ?>
                <?php
                	if(!empty($item['FormEntry']['company'])) {
                		$item['FormEntry']['company'] = $item['FormEntry']['company']=='py' ? 'PARAGUAY' : 'BOLIVIA';
                	}
                ?>
                <tr>
                  <td><?=$item['FormEntry']['created']?></td>
                  <td><?=!empty($item['FormEntry']['type'])?$item['FormEntry']['type']:'<span class="discreet">N/D</span>'?></td>
                  <td><?=!empty($item['FormEntry']['company'])?$item['FormEntry']['company']:'<span class="discreet">N/D</span>'?></td>
                  <td><?=!empty($item['FormEntry']['full_name'])?$item['FormEntry']['full_name']:'<span class="discreet">N/D</span>'?></td>
                  <td><?=!empty($item['FormEntry']['email'])?$item['FormEntry']['email']:'<span class="discreet">N/D</span>'?></td>
                  <td><?=!empty($item['FormEntry']['phone'])?$item['FormEntry']['phone']:'<span class="discreet">N/D</span>'?></td>
                  <td><?=!empty($item['FormEntry']['notes'])?nl2br($item['FormEntry']['notes']):'<span class="discreet">N/D</span>'?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <?php echo $this->Nav->paginator(); ?>
          </div>
        </div>
    </div>
  </div>
</div>
