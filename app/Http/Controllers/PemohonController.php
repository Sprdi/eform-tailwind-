<?php

namespace App\Http\Controllers;

use App\Models\Pemohon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Exports\PemohonsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PemohonsPdfExport;

class PemohonController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(): View
    {
        //get all pemohons
        $pemohons = Pemohon::latest()->paginate(10);

        //render view with pemohons
        return view('eform.index', compact('pemohons'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {

        //get all pemohons
        $pemohons = Pemohon::latest()->paginate(10);

        return view('eform.create', compact('pemohons'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'tujuan' => 'required|string',
            'nama' => 'required|string|max:255',
            'nik' => 'required|numeric|min:16|unique:pemohons,nik',
            'email' => 'required|email|unique:pemohons,email',
            'divisi' => 'required|string|max:255',
            'grup' => 'required|string|max:255',
            'tujuan' => 'required|string',
            'kebutuhan' => 'required|string',
            'akses' => 'required|string',
            'koneksiAplikasi' => 'required|string|max:255',
            'mulai' => 'required|date',
            'sampai' => 'required|date',
            'ipSource' => 'required|array',
            'ipDestination' => 'required|array',
            'port' => 'required|array',
            'initiateConnection' => 'required|string',
            'lampiran' => 'required|string',
        ]);

        // Get the array data from the request
        $ipSource = $request->input('ipSource');
        $ipDestination = $request->input('ipDestination');
        $port = $request->input('port');

        Pemohon::create([
            'tujuan' => $request->tujuan,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'email' => $request->email,
            'divisi' => $request->divisi,
            'grup' => $request->grup,
            'kebutuhan' => $request->kebutuhan,
            'akses' => $request->akses,
            'koneksiAplikasi' => $request->koneksiAplikasi,
            'mulai' => $request->mulai,
            'sampai' => $request->sampai,
            'ipSource' => json_encode($ipSource),
            'ipDestination' => json_encode($ipDestination),
            'port' => json_encode($port),
            'initiateConnection' => $request->initiateConnection,
            'lampiran' => $request->lampiran,
        ]);

        //redirect to index
        return redirect()->route('eform.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get pemohon by ID
        $pemohon = Pemohon::findOrFail($id);

        //render view with pemohon
        return view('eform.show', compact('pemohon'));
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get product by ID
        $pemohon = Pemohon::findOrFail($id);

        //delete product
        $pemohon->delete();

        //redirect to index
        return redirect()->route('eform.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    public function export()
    {
        return Excel::download(new PemohonsExport, 'pemohons.xlsx');
    }
    public function exportPdf(PemohonsPdfExport $pdfExport)
    {
        return $pdfExport->export();
    }

}
