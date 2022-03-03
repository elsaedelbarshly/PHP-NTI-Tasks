<?php 

function returnRedirectAccordingToBtn($request) {
    if ($request->has('submit') && $request->submit === 'index') {
        return redirect()->route('dashboard.products.index')->with('success', 'Operation Successfull');
    } else {
        return redirect()->back()->with('success', 'Operation Successfull');
    }
}