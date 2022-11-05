<?php

namespace App\Observers;

use App\Models\Company;

class CompanyObserver
{
    /**
     * @param Company $company
     * @return void
     */
    public function deleting(Company $company)
    {
        $company->payables()->delete();
        $company->receivables()->delete();
    }

    /**
     * @param Company $company
     * @return void
     */
    public function restoring(Company $company)
    {
        $company->payables()->onlyTrashed()->restore();
        $company->receivables()->onlyTrashed()->restore();
    }
}
