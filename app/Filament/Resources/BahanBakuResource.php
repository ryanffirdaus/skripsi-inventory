<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BahanBakuResource\Pages;
use App\Filament\Resources\BahanBakuResource\RelationManagers;
use App\Models\BahanBaku;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;


class BahanBakuResource extends Resource
{
    protected static ?string $model = BahanBaku::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Bahan Baku';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('nama')->required(),
                TextInput::make('satuan')->required(),
                TextInput::make('stok')->numeric()->default(0),
                TextInput::make('permintaan_per_tahun')->numeric(),
                TextInput::make('biaya_pemesanan')->numeric(),
                TextInput::make('biaya_penyimpanan')->numeric(),
                TextInput::make('lead_time')->numeric(),
                TextInput::make('lead_time_maks')->numeric(),
                TextInput::make('penggunaan_harian_rata2')->numeric(),
                TextInput::make('penggunaan_harian_maks')->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode')
                    ->label('Kode Bahan Baku')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('nama')
                    ->label('Nama Bahan Baku')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('satuan')
                    ->label('Satuan'),
                TextColumn::make('stok')
                    ->label('Stok')
                    ->sortable(),
                TextColumn::make('rop')
                    ->label('Reorder Point'),
                TextColumn::make('eoq')
                    ->label('Economic Order Quantity'),
                TextColumn::make('safety_stock')
                    ->label('Safety Stock'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                    ->hiddenLabel(),
                DeleteAction::make()
                    ->hiddenLabel()
                    ->successNotification(
                        Notification::make()
                            ->title('Bahan Baku berhasil dihapus')
                            ->success()
                    ),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBahanBakus::route('/'),
            'create' => Pages\CreateBahanBaku::route('/create'),
            'edit' => Pages\EditBahanBaku::route('/{record}/edit'),
        ];
    }
}
