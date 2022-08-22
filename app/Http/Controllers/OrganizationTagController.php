<?php

namespace App\Http\Controllers;

use App\Models\OrganizationTag;
use Illuminate\Http\Request;

class OrganizationTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags = OrganizationTag::get();
        return view('organizationTags.index', ['organizationTags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $organizationTag = new OrganizationTag();
        $organizationTag->name = $request->input('id');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrganizationTag  $organizationTag
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $organizationTag = organizationTag::where('name', $id)->firstOrFail();
        return view('organizationTags.show', ['organizationTag' => $organizationTag]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrganizationTag  $organizationTag
     * @return \Illuminate\Http\Response
     */
    public function edit(OrganizationTag $organizationTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrganizationTag  $organizationTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrganizationTag $organizationTag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrganizationTag  $organizationTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrganizationTag $organizationTag)
    {
        //
    }
}
