<?php

namespace App\Http\Controllers;

use App\Models\CashInHand;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\InvestorPay;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\ExpenseDetails;

class ExpenseController extends Controller
{
    //expenselist
    public function expenselist()
    {
        $data = array();
        $data['active_menu'] = 'expence';
        $data['page_title'] = 'Expense List';
        $expense = Expense::all();
        return view('backend.expense.expense_list', compact('expense', 'data'));
    }
    //expensePost
    public function expensePost(Request $request)
    {
        $data = array();
        $data['active_menu'] = 'expence';
        $data['page_title'] = 'Expense List';
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $expense = Expense::whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date)->get();
        return view('backend.expense.expense_list', compact('expense', 'data'));
    }
    //expenseCreate
    public function expenseCreate()
    {
        $data = array();
        $data['active_menu'] = 'expense';
        $data['page_title'] = 'Expense Create';
        $invoice = Invoice::sum('advance');
        $invoicePay = InvestorPay::sum('total');
        $cashhand = CashInHand::sum('amount');
        $totalIncome = ($invoice ?? 0) + ($invoicePay ?? 0) + ($cashhand ?? 0);
        $cashInHand = $totalIncome;
        $employee = Employee::all();
        $category = Category::all();
    
        if (request()->isMethod('post')) {
            $fileNames = [];
    
            if (request()->hasFile('file')) {
                foreach (request()->file('file') as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = 'backend/img/expense/' . uniqid() . '.' . $extension;
                    $file->move('backend/img/expense', $fileName);
                    $fileNames[] = $fileName;
                }
            }
            $expense = new Expense();
            $expense->date = request()->date;
            $expense->note = request()->note;
            $expense->totalAmount = request()->totalAmount;
            $expense->save();
    
            $category_id = request()->input('category_id');
            $amount = request()->input('amount');
    
            foreach ($category_id as $index => $categoryId) {
                $file = $fileNames[$index] ?? null;
                $amounts = $amount[$index] ?? 0;
    
                $expenseDetail = new ExpenseDetails();
                $expenseDetail->expense_id = $expense->id;
                $expenseDetail->category_id = $categoryId;
                $expenseDetail->file = $file;
                $expenseDetail->amount = $amounts;
                $expenseDetail->save();
            }
    
            return redirect('/expense/list')->with('message', 'Expense Successfully Added');
        }
    
        return view('backend.expense.createExpense', compact('employee', 'category', 'data', 'totalIncome', 'cashInHand'));
    }
    public function expenseDestroy($id)
    {
        $expense = Expense::find($id);
        $file = $expense->file;
        if (File::exists($file)) {
            File::delete($file);
        }
        $expense->delete();
        return back()->with('message', 'Expense Successfully Deleted');
    }
    //expenseEdit
    public function expenseEdit($id){
        $expense = Expense::with('categories')->find($id);
        $data = array();
        $data['active_menu'] = 'expense';
        $data['page_title'] = 'Expense Update';
        $invoice = Invoice::sum('advance');
        $invoicePay = InvestorPay::sum('total');
        $cashhand = CashInHand::sum('amount');
        $totalIncome = ($invoice ?? 0) + ($invoicePay ?? 0) + ($cashhand ?? 0);
        $cashInHand = $totalIncome;
        $employee = Employee::all();
        $category = Category::all();
        if (request()->isMethod('post')) {
            $fileNames = [];
    
            if (request()->hasFile('file')) {
                foreach (request()->file('file') as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = 'backend/img/expense/' . uniqid() . '.' . $extension;
                    $file->move('backend/img/expense', $fileName);
                    $fileNames[] = $fileName;
                }
            }
            $expense->date = request()->date;
            $expense->note = request()->note;
            $expense->totalAmount = request()->totalAmount;
            $expense->save();
    
            $category_id = request()->input('category_id');
            $amount = request()->input('amount');
    
            foreach ($category_id as $index => $categoryId) {
                $file = $fileNames[$index] ?? null;
                $amounts = $amount[$index] ?? 0;
    
                $expenseDetail = new ExpenseDetails();
                $expenseDetail->expense_id = $expense->id;
                $expenseDetail->category_id = $categoryId;
                $expenseDetail->file = $file;
                $expenseDetail->amount = $amounts;
                $expenseDetail->save();
            }
    
            return redirect('/expense/list')->with('message', 'Expense Successfully Added');
        }
        return view('backend.expense.editExpense',compact('employee', 'category', 'data', 'totalIncome', 'cashInHand','expense'));
    }
}
