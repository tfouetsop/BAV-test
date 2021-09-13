@extends('layouts.app1')

@section('main-title','Liste des produits')

@section('title','Produits')
@section('main')
  <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        @component('components.alert')
            @slot('status')
                {{ session('status') }}
            @endslot
            @slot('error')
                {{ session('error') }}
            @endslot
            {!! session('message') !!}
        @endcomponent

        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-success">
              <div class="card-header">
                <h3 class="card-title">Liste des prduits</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <a href="{{ route('product.create') }}" class="btn btn-block btn-success col-md-2">Nouveau</a>

                <table class="table table-striped">
                  <thead>                  
                    <tr>
                      <th>No</th>
                      <th>Nom</th>
                      <th>Image</th>
                      <th>Prix Unitaire</th>
                      <th>Quantité</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i = 0; @endphp
                    @foreach($products as $product)
                        @php $i++; @endphp
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ $product->name }}</td>
                          <td>Image</td>
                          <td>{{ $product->price }}</td>
                          <td>{{ $product->quantity }}</td>
                          <td>
                                <a  href="{{ route('product.show', $product->id) }}" title="Détails" class="btn btn-secondary">
                                    <span class="fa fa-pencil">Détails</span>
                                </a>

                                <a  href="{{ route('product.edit', $product->id) }}" title="Modifier le produit" class="btn btn-warning">
                                    <span class="fa fa-pencil">Modifier</span>
                                </a>
                                
                                <a href="#" title="Supprimer le produit" class="btn btn-danger">
                                    <span class="fa fa-trash">Supprimer</span>
                                </a>
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

      <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
          
          <div id="detail" class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Produit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

          </div>
        </div>

      </div>


    </section>
    <!-- /.content -->
@endsection
