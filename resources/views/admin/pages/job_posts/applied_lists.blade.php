@extends('admin.layouts.template')
@push('admin_title')
    Job Applied Lists
@endpush
@push('admin_css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('admin_content')
    @push('admin_breadcumb')
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>
        Job Applied Lists
    @endpush
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('job-posts.index') }}" class="btn btn-sm btn-info">Go to job lists</a>

                    <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="unseen-tab" data-bs-toggle="tab" data-bs-target="#unseen" type="button" role="tab" aria-controls="unseen" aria-selected="true">Unseen <span class="text-danger">({{ count($jobAppliedUnseen) }})</span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="seen-tab" data-bs-toggle="tab" data-bs-target="#seen" type="button" role="tab" aria-controls="seen" aria-selected="false">Seen <span class="text-danger">({{ count($jobAppliedSeen) }})</span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="shortlist-tab" data-bs-toggle="tab" data-bs-target="#shortlist" type="button" role="tab" aria-controls="shortlist" aria-selected="false">Shortlist <span class="text-danger">({{ count($jbApplSrtlstd) }})</span></button>
                        </li>
                      </ul>
                      <div class="tab-content my-4" id="myTabContent">
                        <div class="tab-pane fade show active" id="unseen" role="tabpanel" aria-labelledby="unseen-tab">
                           <div class="row">
                                @foreach ($jobAppliedUnseen as $unseen)
                                    <div class="col-md-6 my-2">
                                        <div class="card shadow ">
                                            <div class="d-flex justify-content-between">
                                                <div class="card-body p-4">

                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>Full Name</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8">{{ $unseen->full_name ?? '' }}</div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>Email</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8">{{ $unseen->email ?? '' }}</div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>Phone</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8">{{ $unseen->phone ?? '' }}</div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>Apply Date</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8">{{ Carbon\Carbon::parse($unseen->created_at)->format('Y-m-d h:i A') ?? '' }}</div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>CV Link</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8"><a href="{{ asset('/storage/admin/assets/images/cv/'.$unseen->cv) }}" target="_blank">Click for view</a></div>
                                                    </div>
                                                    @if ($unseen->portfolio_type == 'pdf')
                                                        <div class="row mb-3">
                                                            <div class="col-3"><strong>Portfolio PDF</strong></div>
                                                            <div class="col-1"><strong>:</strong></div>
                                                            <div class="col-8"><a href="{{ asset('/storage/admin/assets/images/portfolio/'.$unseen->portfolio) }}" target="_blank">Click for view</a></div>
                                                        </div>
                                                    @elseif($unseen->portfolio_type == 'link')
                                                        <div class="row mb-3">
                                                            <div class="col-3"><strong>Portfolio Link</strong></div>
                                                            <div class="col-1"><strong>:</strong></div>
                                                            <div class="col-8">
                                                                @php
                                                                    $portfolios = json_decode($unseen->portfolio, true);
                                                                @endphp
                                                                @foreach ($portfolios as $item)
                                                                    <a href="{{ $item }}" target="_blank">{{ $item }}</a><br>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="gap-2">
                                                    <a href="{{ route('jobAppliedStatus',['id'=>$unseen->id,'status'=>'1']) }}" class="btn btn-sm btn-info" title="Seen"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('jobAppliedStatus',['id'=>$unseen->id,'status'=>'2']) }}" class="btn btn-sm btn-success" title="Shortlist"><i class="fa fa-check-circle"></i></a>
                                                    <a href="{{ route('jobAppliedStatus',['id'=>$unseen->id,'status'=>'delete']) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this job application?')" title="Delete"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                           </div>
                        </div>
                        <div class="tab-pane fade" id="seen" role="tabpanel" aria-labelledby="seen-tab">
                            <div class="row">
                                @foreach ($jobAppliedSeen as $seen)
                                    <div class="col-md-6 my-2">
                                        <div class="card shadow ">
                                            <div class="d-flex justify-content-between">
                                                <div class="card-body p-4">
                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>Full Name</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8">{{ $seen->full_name ?? '' }}</div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>Email</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8">{{ $seen->email ?? '' }}</div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>Phone</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8">{{ $seen->phone ?? '' }}</div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>Apply Date</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8">{{ Carbon\Carbon::parse($seen->created_at)->format('Y-m-d h:i A') ?? '' }}</div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>CV Link</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8"><a href="{{ asset('/storage/admin/assets/images/cv/'.$seen->cv) }}" target="_blank">Click for view</a></div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>CV Link</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8"><a href="{{ asset('/storage/admin/assets/images/cv/'.$seen->cv) }}" target="_blank">Click for view</a></div>
                                                    </div>
                                                </div>
                                                <div class="gap-2">
                                                    <a href="{{ route('jobAppliedStatus',['id'=>$seen->id,'status'=>'0']) }}" class="btn btn-sm btn-primary" title="Unseen"><i class="fa fa-eye-slash"></i></a>
                                                    <a href="{{ route('jobAppliedStatus',['id'=>$seen->id,'status'=>'2']) }}" class="btn btn-sm btn-success" title="Shortlist"><i class="fa fa-check-circle"></i></a>
                                                    <a href="{{ route('jobAppliedStatus',['id'=>$seen->id,'status'=>'delete']) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this job application?')" title="Delete"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                           </div>
                        </div>
                        <div class="tab-pane fade" id="shortlist" role="tabpanel" aria-labelledby="shortlist-tab">
                            <div class="row">
                                @foreach ($jbApplSrtlstd as $shortlist)
                                    <div class="col-md-6 my-2">
                                        <div class="card shadow ">
                                            <div class="d-flex justify-content-between">
                                                <div class="card-body p-4">
                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>Full Name</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8">{{ $shortlist->full_name ?? '' }}</div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>Email</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8">{{ $shortlist->email ?? '' }}</div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>Phone</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8">{{ $shortlist->phone ?? '' }}</div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>Apply Date</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8">{{ Carbon\Carbon::parse($shortlist->created_at)->format('Y-m-d h:i A') ?? '' }}</div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-3"><strong>CV Link</strong></div>
                                                        <div class="col-1"><strong>:</strong></div>
                                                        <div class="col-8"><a href="{{ asset('/storage/admin/assets/images/cv/'.$shortlist->cv) }}" target="_blank">Click for view</a></div>
                                                    </div>
                                                </div>
                                                <div class="gap-2">
                                                    <a href="{{ route('jobAppliedStatus',['id'=>$shortlist->id,'status'=>'0']) }}" class="btn btn-sm btn-primary" title="Unseen"><i class="fa fa-eye-slash"></i></a>
                                                    <a href="{{ route('jobAppliedStatus',['id'=>$shortlist->id,'status'=>'1']) }}" class="btn btn-sm btn-info" title="Seen"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('jobAppliedStatus',['id'=>$shortlist->id,'status'=>'delete']) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this job application?')" title="Delete"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                           </div>
                        </div>
                      </div>

                </div>
            </div>
        </div>
    </div>
@endsection

