<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Arcanedev\LogViewer\Http\Controllers\Controller as LogBaseController;
use Arcanedev\LogViewer\Entities\Log;
use Arcanedev\LogViewer\Exceptions\LogNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Arcanedev\LogViewer\Tables\StatsTable;

class LogViewerController extends LogBaseController
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    protected $perPage = 30;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct()
    {
        parent::__construct();

        $this->perPage = config('log-viewer.per-page', $this->perPage);
    }

    public function view($view, $data = [], $mergeData = [])
    {
        return view('admin.logs.' . $view, $data, $mergeData);
    }
    /**
     * Show the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stats     = $this->logViewer->statsTable();
        $chartData = $this->prepareChartData($stats);
        $percents  = $this->calcPercentages($stats->footer(), $stats->header());

        return $this->view('dashboard', compact('chartData', 'percents', 'stats'));
    }

    /**
     * List all logs.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\View\View
     */
    public function listLogs(Request $request)
    {
        $stats   = $this->logViewer->statsTable();
        $headers = $stats->header();
        $rows    = $this->paginate($stats->rows(), $request);

        return $this->view('logs', compact('headers', 'rows', 'footer', 'stats'));
    }

    /**
     * Show the log.
     *
     * @param  string  $date
     *
     * @return \Illuminate\View\View
     */
    public function show($date)
    {
        $stats   = $this->logViewer->statsTable();
        $log     = $this->getLogOrFail($date);
        $levels  = $this->logViewer->levelsNames();
        $entries = $log->entries()->paginate($this->perPage);

        return $this->view('show', compact('log', 'levels', 'entries', 'stats'));
    }

    /**
     * Filter the log entries by level.
     *
     * @param  string  $date
     * @param  string  $level
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showByLevel($date, $level)
    {
        $stats   = $this->logViewer->statsTable();

        $log = $this->getLogOrFail($date);

        if ($level === 'all')
            return redirect()->route($this->showRoute, [$date]);

        $levels  = $this->logViewer->levelsNames();
        $entries = $this->logViewer
            ->entries($date, $level)
            ->paginate($this->perPage);

        return $this->view('show', compact('log', 'levels', 'entries', 'stats'));
    }

    /**
     * Download the log
     *
     * @param  string  $date
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($date)
    {
        return $this->logViewer->download($date);
    }

    /**
     * Delete a log.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        if ( ! $request->ajax())
            abort(405, 'Method Not Allowed');

        $date = $request->get('date');

        return response()->json([
            'result' => $this->logViewer->delete($date) ? 'success' : 'error'
        ]);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Paginate logs.
     *
     * @param  array                     $data
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function paginate(array $data, Request $request)
    {
        $page   = $request->get('page', 1);
        $offset = ($page * $this->perPage) - $this->perPage;
        $items  = array_slice($data, $offset, $this->perPage, true);
        $rows   = new LengthAwarePaginator($items, count($data), $this->perPage, $page);

        $rows->setPath($request->url());

        return $rows;
    }

    /**
     * Get a log or fail
     *
     * @param  string  $date
     *
     * @return \Arcanedev\LogViewer\Entities\Log|null
     */
    protected function getLogOrFail($date)
    {
        $log = null;

        try {
            $log = $this->logViewer->get($date);
        }
        catch (LogNotFoundException $e) {
            abort(404, $e->getMessage());
        }

        return $log;
    }

    /**
     * Prepare chart data.
     *
     * @param  \Arcanedev\LogViewer\Tables\StatsTable  $stats
     *
     * @return string
     */
    protected function prepareChartData(StatsTable $stats)
    {
        $totals = $stats->totals()->all();

        return json_encode([
            'labels'   => Arr::pluck($totals, 'label'),
            'datasets' => [
                [
                    'data'                 => Arr::pluck($totals, 'value'),
                    'backgroundColor'      => Arr::pluck($totals, 'color'),
                    'hoverBackgroundColor' => Arr::pluck($totals, 'highlight'),
                ],
            ],
        ]);
    }

    /**
     * Calculate the percentage.
     *
     * @param  array  $total
     * @param  array  $names
     *
     * @return array
     */
    protected function calcPercentages(array $total, array $names)
    {
        $percents = [];
        $all      = Arr::get($total, 'all');

        foreach ($total as $level => $count) {
            $percents[$level] = [
                'name'    => $names[$level],
                'count'   => $count,
                'percent' => $all ? round(($count / $all) * 100, 2) : 0,
            ];
        }

        return $percents;
    }
}
