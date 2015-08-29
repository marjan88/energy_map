<?php foreach($plants as $plant) { ?>
<div class="col-sm-9 col-md-10 main">
    <div class="page-header">
        <h3>
            <?php  echo $plant->Ort ?>  <small>-  <?php  echo $plant->Strasse  ?> </small>

        </h3>
    </div>
    <table id="table" class="table table-striped table-hover ">

        <tbody>
            <tr>
                <td><strong>Inbetriebnahme:</strong></td>
                <td><?php  echo $plant->Inbetriebnahme  ?> </td>
            </tr>
            <tr>
                <td><strong>Postleitzahl:</strong></td>
                <td><?php  echo  $plant->PLZ  ?> </td>
            </tr>
            <tr>
                <td><strong>Bundesland:</strong></td>
                <td><?php  echo  $plant->bundesland ?> </td>
            </tr>
            <tr>
                <td><strong>Ort:</strong></td>
                <td><?php  echo  $plant->Ort  ?> </td>
            </tr>
            <tr> 
                <td><strong>Strasse:</strong></td>
                <td> <?php  echo  $plant->Strasse  ?></td>
            </tr>
            <tr>
                <td><strong>Anlagentyp:</strong></td>
                <td> <?php  echo  $plant->Anlagentyp  ?></td>
            </tr>
            <tr>
                <td><strong>kWh 2013:</strong></td>
                <td> <?php  echo  $plant->kWh_2013  ?></td>
            </tr>
            <tr>
                <td><strong>kWh Average:</strong></td>
                <td> <?php  echo  $plant->kWh_average ?></td>
            </tr>
            <tr>
                <td><strong>DSO:</strong></td>
                <td> <?php  echo  $plant->DSO  ?></td>
            </tr>
            <tr>
                <td><strong>TSO:</strong></td>
                <td> <?php  echo  $plant->TSO  ?></td>
            </tr>
            <tr>
                <td><strong>Anlagenschluessel:</strong></td>
                <td><?php  echo  $plant->Anlagenschluessel  ?> </td>
            </tr>
            <tr>
                <td><strong>installierte Leistung KwP:</strong></td>
                <td> <?php  echo  $plant->leistung  ?></td>
            </tr>
            <tr>
                <td><strong>Energietraeger:</strong></td>
                <td> <?php  echo  $plant->energietraeger ?></td>
            </tr>
            <tr>
                <td><strong>Netzbetreiber:</strong></td>
                <td> <?php  echo  $plant->netzbetreiber  ?></td>
            </tr>
            <tr>
                <td><strong>Anschrift:</strong></td>
                <td> <?php  echo  $plant->anschrift  ?></td>
            </tr>
            <tr>
                <td><strong>Anlagenhersteller:</strong></td>
                <td> <?php  echo  $plant->anlagenhersteller  ?></td>
            </tr>
            <tr>



        </tbody>
    </table>

</div>
<?php } ?>
