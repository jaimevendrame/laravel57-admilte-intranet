
<div class="form-group col-md-12">
    <label for="InputTitle">Título</label>
    <input type="text" class="form-control" id="InputTitle" name="title" placeholder="Título de sua ideia" value="{{ $data->title ?? old('title')}}">
</div>
<div class="form-group col-md-4">
    <label>Selecione um categoria</label>

    <select name="category_id" id="category_id" class="form-control">
        {{--<option value="">Escolha a Categoria</option>--}}
        @foreach( $categories as $cat)
            <option value="{{$cat->id}}"
                    @if(isset($data->category_id) && $data->category_id == $cat->id )
                    selected
                    @endif
            >{{$cat->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-md-4">
    <label for="Inputdata">Data</label>
    <input type="text" class="form-control date-picker" id="Inputdata" name="date"    value=" @if(isset($data->date)) {{\Carbon\Carbon::parse($data->date)->format('d/m/Y')}} @else {{\Carbon\Carbon::now()->format('d/m/Y')}} @endif" readonly>
</div>
<div class="form-group col-md-4">
    <label for="Inputhour">Horário</label>
    <input type="text" class="form-control bootstrap-timepicker timepicker" name="hour" id="Inputhour"  value="{{$data->hour ??  \Carbon\Carbon::now()->format('H:i')}}" readonly>
</div>

<!-- textarea -->
<div class="form-group col-md-12">
    <label>Descrição de sua ideia</label>
    <textarea class="form-control" rows="10" name="description" id="description" placeholder="Digite aqui a sua ideia">{{$data->description ?? old('description')}}</textarea>
</div>
<div class="form-group col-md-12">
    <label for="InputTags">Tags do sua ideia</label>
    <input type="text" class="form-control" id="tags" name="tags" placeholder="Digite aqui as palavras chaves que representam sua ideia" value="{{$data->tags ?? old('tags')}}">
</div>

<div class="form-group col-md-4">
    <label for="InputFile">Anexar arquivo</label>
    <input type="file" id="InputFile" name="file">
</div>
<div class="col-md-4">
    @if(isset($data->file))
        <a href="{{URL::asset('/assets/uploads/ideas/'.$data->file)}}" target="_blank" class="btn btn-app"> <i class="fa  fa-file-archive-o"></i>Anexo</a>
    @else
        <h5><strong>SEM ANEXO</strong></h5>
    @endif
</div>
{{--/--}}
{{--Área de uso da assessoria--}}
@can('view_ideas', App\Models\Idea::class)

    @cannot('admin')
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget widget-user-2">
                        <div class="widget-user-header bg-light-blue-gradient">
                            <div class="widget-user-image">
                                @if( isset($data->user->image))
                                    <img src="{{URL::asset('/assets/uploads/users/'. $data->user->image)}}" alt="{{ $data->user->name}}" alt="{{ $data->user->name}}" class="user-image img-circle img-responsive">
                                @else
                                    <img src="{{URL::asset('/assets/uploads/users/no-image.png')}}" alt="{{ $data->user->name}}" class="user-image img-circle img-responsive">
                                @endif
                            </div>
                            <h3 class="widget-user-username">{{$data->user->name}}</h3>
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
                                    @if(isset($data->user->sector->initials))
                                        <li><h5><strong>Setor: </strong></h5>
                                            <p>{{$data->user->sector->initials}}</p>
                                        </li>
                                    @endif
                                @endif
                            </ul>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.box -->'
    @endcannot
    <div class="form-group col-md-12">
        <div class="checkbox">
            <label>
                {{--<input type="checkbox" name="featured" @if(isset($data)&& $data->featured == 1) checked @endif> Destaque?--}}
            </label>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Selecione o status da ideia</label>
        <select class="form-control" name="status" id="status">
            <option value="P" @if( isset($data['status'])) {{$data['status'] == 'P'? 'selected':''}}@endif>Pendente</option>
            <option value="A" @if( isset($data['status'])) {{$data['status'] == 'A'? 'selected':''}}@endif>Aprovado</option>
            <option value="R" @if( isset($data['status'])) {{$data['status'] == 'R'? 'selected':''}}@endif>Rejeitado</option>
        </select>
    </div>
    <!-- textarea -->
    <div class="form-group col-md-12">
        <label>Justificativa do Status</label>
        <textarea class="form-control" rows="5" name="answer_status" id="answer_status" placeholder="Digite aqui ...">{{$data->answer_status ?? old('answer_status')}}</textarea>
    </div>
    <!-- textarea -->
    <div class="form-group col-md-12">
        <label>Observações</label>
        <textarea class="form-control" rows="5" name="comments" id="comments" placeholder="Digite aqui ...">{{$data->comments ?? old('comments')}}</textarea>
    </div>
    {{--/--}}

@endcan