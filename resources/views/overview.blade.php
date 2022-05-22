@extends('layouts.app')

@section('title')
    Overview
@endsection

@section('menu')
    @parent
    <li class="nav-item"><a href="/" class="nav-link active" aria-current="page">Overview</a></li>
    <li class="nav-item"><a href="#" class="nav-link">Table</a></li>
    <li class="nav-item"><a href="#" class="nav-link">Graphics</a></li>
@endsection

@section('content')
    <h4 class="pt-3" style="text-align: center!important;">Enter the time period you want to explore</h4>
    <div class="center" style="display: flex; justify-content: center;">
        <form action="/graphics" method="get" class="pt-3">
            <div class="form-row">
                <div class="form-group">
                    <label for="date1">Date from</label><input type="date" class="form-control mt-1" id="date1" name="date1" min="2012-01-01" max="2012-12-31" placeholder="Date from" value="2012-01-01" required>
                    <label for="date2">Date to</label><input type="date" class="form-control mt-1" id="date2" name="date2" min="2012-01-01" max="2012-12-31" placeholder="Date to" value="2012-12-31" required>
                </div>
            </div>
            <div class="center" style="display: flex; justify-content: center;">
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
        </form>
    </div>
    <h4 style="padding-top: 3rem; text-align: center!important;">Select a day to view statistics for it</h4>
    <div class="flex-shrink-0 p-3 bg-white" style="padding-left: 30% !important; padding-right: 30% !important;">
        <ul class="list-unstyled ps-0">
            <?php $month_num = 1; ?>
            <?php foreach (array_keys($data) as $month): ?>
                <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" style="width:100%;!important;" data-bs-toggle="collapse" data-bs-target="#<?= $month ?>-collapse" aria-expanded="false">
                    <?= $month ?>
                </button>
                <div class="collapse" id="<?= $month ?>-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <?php for ($i = 1; $i < count($data[$month][0]) + 1; $i++ ): ?>
                            <li class="child-li"><a href="/table?m={{$month}}&month={{$month_num}}&day={{$i}}" class="link-dark d-inline-flex text-decoration-none rounded"><?= $i ?></a></li>
                        <?php endfor ?>
                    </ul>
                </div>
            </li>
                <?php ++$month_num; ?>
            <?php endforeach ?>
        </ul>
    </div>
    <script src="https://getbootstrap.com/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
@endsection

