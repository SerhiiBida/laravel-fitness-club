@extends('admin.layouts.base')

@section('content')
    <section class="container-lg py-2 min-vh-100">
        <h1 class="text-center py-2">
            Dashboard
        </h1>
        {{--Общая статистика по сайту--}}
        @if (in_array('view statistics', $permissions))
            <h2 class="text-center">
                Statistics for the month
            </h2>
            <div class="row justify-content-center row-height">
                <div class="col-12 col-sm-6 col-md-3 mt-3 mb-3">
                    <div class="square d-flex justify-content-center align-items-center text-bg-success">
                        <div>
                            <h4 class="text-center">
                                Users:
                            </h4>
                            <h1 class="text-center">
                                +{{ $statistics['countUsers'] }}
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mt-3 mb-3">
                    <div class="square d-flex justify-content-center align-items-center text-bg-danger">
                        <div>
                            <h4 class="text-center">
                                Trainings:
                            </h4>
                            <h1 class="text-center">
                                +{{ $statistics['countTrainings'] }}
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mt-3 mb-3">
                    <div class="square d-flex justify-content-center align-items-center text-bg-secondary">
                        <div>
                            <h4 class="text-center">
                                Memberships:
                            </h4>
                            <h1 class="text-center">
                                +{{ $statistics['countMemberships'] }}
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mt-3 mb-3">
                    <div class="square d-flex justify-content-center align-items-center text-bg-primary">
                        <div>
                            <h4 class="text-center">
                                Memberships Purchased:
                            </h4>
                            <h1 class="text-center">
                                +{{ $statistics['countMembershipsPurchased'] }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{--Генерация отчета--}}
        @if (in_array('download global_report', $permissions))
            <h3 class="text-center pt-3">
                <a href="{{ route('admin.globalReport') }}" class="btn btn-success">
                    Get report
                </a>
            </h3>
        @endif
    </section>
@endsection
