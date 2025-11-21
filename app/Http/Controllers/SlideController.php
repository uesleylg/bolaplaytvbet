<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    /**
     * Atualiza ou cria os 3 slides fixos
     */
    public function store(Request $request)
    {
        $request->validate([
            'slides.*.desktop' => 'nullable|image',
            'slides.*.mobile'  => 'nullable|image',
        ]);

        for ($i = 1; $i <= 3; $i++) {

            // Pega ou cria o slide
            $slide = Slide::firstOrCreate(
                ['ordem' => $i],
                ['ativo' => 1]
            );

            // Atualizar Desktop
            if ($request->hasFile("slides.$i.desktop")) {

                // Apaga antigo
                if ($slide->imagem_desktop && Storage::disk('public')->exists($slide->imagem_desktop)) {
                    Storage::disk('public')->delete($slide->imagem_desktop);
                }

                // Salva novo
                $slide->imagem_desktop = $request->file("slides.$i.desktop")
                    ->store('slides', 'public');
            }

            // Atualizar Mobile
            if ($request->hasFile("slides.$i.mobile")) {

                if ($slide->imagem_mobile && Storage::disk('public')->exists($slide->imagem_mobile)) {
                    Storage::disk('public')->delete($slide->imagem_mobile);
                }

                $slide->imagem_mobile = $request->file("slides.$i.mobile")
                    ->store('slides', 'public');
            }

            $slide->save();
        }

        return back()->with('success', 'Slides atualizados com sucesso!');
    }


    /**
     * Atualiza individualmente um slide (se usar edição por ID)
     */
    public function update(Request $request, Slide $slide)
    {
        $request->validate([
            'imagem_desktop' => 'nullable|image',
            'imagem_mobile'  => 'nullable|image',
        ]);

        // Desktop
        if ($request->hasFile('imagem_desktop')) {

            if ($slide->imagem_desktop && Storage::disk('public')->exists($slide->imagem_desktop)) {
                Storage::disk('public')->delete($slide->imagem_desktop);
            }

            $slide->imagem_desktop = $request->file('imagem_desktop')
                ->store('slides', 'public');
        }

        // Mobile
        if ($request->hasFile('imagem_mobile')) {

            if ($slide->imagem_mobile && Storage::disk('public')->exists($slide->imagem_mobile)) {
                Storage::disk('public')->delete($slide->imagem_mobile);
            }

            $slide->imagem_mobile = $request->file('imagem_mobile')
                ->store('slides', 'public');
        }

        $slide->save();

        return back()->with('success', 'Slide atualizado com sucesso!');
    }


    /**
     * Remove slide COMPLETO: desktop + mobile + registro
     */
    public function destroy(Slide $slide)
    {
        if ($slide->imagem_desktop && Storage::disk('public')->exists($slide->imagem_desktop)) {
            Storage::disk('public')->delete($slide->imagem_desktop);
        }

        if ($slide->imagem_mobile && Storage::disk('public')->exists($slide->imagem_mobile)) {
            Storage::disk('public')->delete($slide->imagem_mobile);
        }

        $slide->delete();

        return back()->with('success', 'Slide removido com sucesso!');
    }


    /**
     * EXCLUI SÓ UMA IMAGEM (desktop OU mobile)
     */
    public function deleteImage(Request $request, Slide $slide)
    {
        $request->validate([
            'type' => 'required|in:desktop,mobile'
        ]);

        if ($request->type === 'desktop') {
            if ($slide->imagem_desktop && Storage::disk('public')->exists($slide->imagem_desktop)) {
                Storage::disk('public')->delete($slide->imagem_desktop);
            }
            $slide->imagem_desktop = null;
        }

        if ($request->type === 'mobile') {
            if ($slide->imagem_mobile && Storage::disk('public')->exists($slide->imagem_mobile)) {
                Storage::disk('public')->delete($slide->imagem_mobile);
            }
            $slide->imagem_mobile = null;
        }

        $slide->save();

        return back()->with('success', 'Imagem removida com sucesso!');
    }
}
