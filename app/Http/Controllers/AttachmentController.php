<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function download($id)
    {
        $attachment = Attachment::findOrFail($id);
        $filePath = $attachment->file_path;

        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath);
        }

        return redirect()->back()->with('success', 'File not found.');
    }

    public function destroy($id)
    {
        $attachment = Attachment::findOrFail($id);
        $filePath = $attachment->file_path;

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            $attachment->delete();
            return back()->with('success', 'Attachment deleted successfully');
        }

        return back()->with('success', 'File not found.');
    }
}