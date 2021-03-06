<table id="migration-tree-table-<?=$type?>" class="migration-table table table-bordered table-striped">
    <colgroup>
        <col width="*"></col>
        <col width="120px"></col>
        <col width="30px"></col>
    </colgroup>
    <thead>
    <tr> <th><?=t('Name')?></th> <th><?=t('Handle')?></th> <th> </th> </tr>
    </thead>
    <tbody>
    </tbody>
</table>


<script type="text/javascript">
    $(function() {
        $("#migration-tree-table-<?=$type?>").migrationBatchTableTree({
            columnKey: 'page_type',
            renderInitialColumnData: function(cells, data) {
                var node = data.node;
                cells.eq(1).text(node.data.handle);
                cells.eq(2).html('<i class="' + node.data.statusClass + '"></i>');
            },
            lazyLoad: function(event, data) {
                data.result = {
                    url: '<?=$view->action('load_batch_page_data')?>',
                    data: {'id': data.node.data.id}
                }
            },
            source: {
                url: '<?=$view->action('load_batch_collection')?>',
                data: {'id': '<?=$collection->getID()?>'}
            }
        });
    });
</script>