<div class="box box-widget widget-user-2">
    <div class="widget-user-header bg-light-blue-gradient">
        <div class="">
            @if( isset($data->user->image))
                <img src="{{URL::asset('/assets/uploads/users/'. $data->user->image)}}" alt="{{ $data->user->name}}" alt="{{ $data->user->name}}" class="user-image2 img-responsive">
            @else
                <img src="{{URL::asset('/assets/uploads/users/no-image.png')}}" alt="{{ $data->user->name}}" class="user-image2 img-responsive">
            @endif
        </div>
        <span><small>Autor:</small></span>
        <h3 class="widget-user-username">{{$data->user->name. " ".$data->user->last_name}}</h3>
        <h5 class="widget-user-desc">{{$data->user->email}}</h5>
    </div>
    <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
            <li><b>Data/horário do Cadastro: </b>{!! Carbon\Carbon::parse($data->date)->format('d/m/Y') !!} - {!! $data->hour !!}</li>
            <li><h5><strong>{{$data->title}}</strong></h5>
            <p>{{$data->description}}</p>
            </li>
            <li><h5><strong>Categoria: </strong>{{$data->category->name}}</h5></li>
            <li><h5><strong>Status: </strong>@if($data->status == 'P') <span class="label label-warning">Pendente</span> @elseif($data->status == 'A') <span class="label label-success">Aprovada</span> @else <span class="label label-danger">Rejeitado</span> @endif</h5></li>
            @if(isset($data->file))
                <li><h5><strong>Arquivo Anexo: </strong><a href="{{URL::asset('/assets/uploads/ideas/'.$data->file)}}" target="_blank" class="btn btn-app"> <i class="fa  fa-file-archive-o"></i></a></h5></li>
                @else
                <li><h5><strong>Arquivo Anexo: </strong>SEM ANEXO</h5></li>
            @endif
            <li><h5><strong>Tags (palavras-chaves) relacionadas a ideia</strong></h5>
                <p>{{$data->tags}}</p>
            </li>

            @if($data->status != 'P')
                <li><h5><strong>Justificativa do status</strong></h5>
                    <p>{{$data->answer_status}}</p>
                </li>
                @if(isset($data->comments))
                    <li><h5><strong>Observações:</strong></h5>
                        <p>{{$data->comments}}</p>
                    </li>
                    @endif
            @endif
            @if(isset($data->assessor_id))
            <li><h5><strong>Assessor: </strong></h5>
                <p>{{$data->assessor->name}}</p>
            </li>
            @endif

            @if(isset($data->sector_id))
            <li><h5><strong>Setor: </strong></h5>
                <p>{{$data->sector->name}}</p>
            </li>
            @endif
        </ul>
    </div>
</div>