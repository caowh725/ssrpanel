@extends('admin.layouts')

@section('css')
    <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection
@section('title', '控制面板')
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{url('ticket/ticketList')}}">工单列表</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-question font-dark"></i>
                            <span class="caption-subject bold uppercase"> 工单列表 </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> 账号 </th>
                                    <th> 标题 </th>
                                    <th> 状态 </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($ticketList->isEmpty())
                                    <tr>
                                        <td colspan="4">暂无数据</td>
                                    </tr>
                                @else
                                    @foreach($ticketList as $key => $ticket)
                                        <tr class="odd gradeX">
                                            <td> {{$key + 1}} </td>
                                            <td> <a href="{{url('admin/userList?username=' . $ticket->user->username)}}" target="_blank">{{$ticket->user->username}}</a> </td>
                                            <td> <a href="{{url('ticket/replyTicket?id=') . $ticket->id}}" target="_blank">{{$ticket->title}}</a> </td>
                                            <td>
                                                @if ($ticket->status == 0)
                                                    <span class="label label-info"> 待处理 </span>
                                                @elseif ($ticket->status == 1)
                                                    <span class="label label-danger"> 已回复 </span>
                                                @else
                                                    <span class="label label-default"> 已关闭 </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$ticketList->total()}} 个工单</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $ticketList->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script type="text/javascript">
        // 回复工单
        function reply(id) {
            window.location.href = '{{url('ticket/replyTicket?id=')}}' + id;
        }
    </script>
@endsection