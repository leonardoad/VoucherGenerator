<div class="row">
    <div class="col-12">
        {if $msg1 != ''}
            <div class="alert alert-success">
                {$msg1}
            </div>
        {/if}
        {if $msg2 != ''}
            <div class="alert alert-warning">
                {$msg2}
            </div>
        {/if}
        <div class="card-box  ">
            <div class="panel-heading text-right" >
                {$btnEdit}
            </div>
            <div class="panel-body">
                {$grid}
            </div>
        </div>
    </div>
</div>