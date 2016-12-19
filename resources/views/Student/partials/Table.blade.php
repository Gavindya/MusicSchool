<div class="container-fluid">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
            </tr>
            </thead>
            <tbody>
            <?php
            echo var_dump($students); ?>
            @for($i =0; $i < sizeof($students); $i++)
                <tr>

                    <td>{{$students[$i]['id']}}</td>
                    <td>{{$students[$i]['name']}}</td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
</div>