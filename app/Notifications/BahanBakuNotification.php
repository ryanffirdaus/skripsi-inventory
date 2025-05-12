<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class BahanBakuNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $bahanBaku;

    /**
     * Create a new notification instance.
     */
    public function __construct($bahanBaku)
    {
        $this->bahanBaku = $bahanBaku;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail', 'telegram', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Notifikasi Bahan Baku')
            ->line('Stok bahan baku ' . $this->bahanBaku->nama . ' telah diperbarui.')
            ->line('Stok saat ini: ' . $this->bahanBaku->stok)
            ->line('ROP: ' . $this->bahanBaku->rop)
            ->action('Lihat Detail', url('/bahan-baku/' . $this->bahanBaku->id));
    }

    /**
     * Get the Telegram representation of the notification.
     */
    public function toTelegram($notifiable)
    {
        return (new TelegramMessage)
            ->content('Stok bahan baku ' . $this->bahanBaku->nama . ' telah diperbarui. Stok saat ini: ' . $this->bahanBaku->stok . ', ROP: ' . $this->bahanBaku->rop);
    }

    /**
     * Get the broadcast representation of the notification.
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => 'Notifikasi Bahan Baku',
            'message' => 'Stok bahan baku ' . $this->bahanBaku->nama . ' telah diperbarui.',
            'stok' => $this->bahanBaku->stok,
            'rop' => $this->bahanBaku->rop,
        ]);
    }
}
